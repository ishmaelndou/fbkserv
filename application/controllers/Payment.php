<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Payment_model');

        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');

        if(isset($_GET['i']) && !empty($_GET['i'])){
            $this->payment_model->checkLogin($_GET['i']);
        }

        if(!$this->session->userdata('payment_details') || !$this->session->userdata('user_id')){
            $this->session->set_flashdata('error_message', site_phrase('payment_not_configured_yet'));
            redirect(site_url(), 'refresh');
        }  
    }

    function index(){
        $page_data['page_title'] = get_phrase('payment');
        $this->load->view('payment-global/payment_gateway.php', $page_data);

        $this->load->helper('url');  // Load the URL helper
	//$this->load->helper('base_url');
       // $this->load->view('payment-global/payment_gateway');
    }
public function checkout() {
    // Set up the PayFast parameters with the numeric amount
	$payer_user_id = $this->session->userdata('user_id');
        $enrol_user_id = $payer_user_id;
        $payment_details = $this->session->userdata('payment_details');
	$payment_id = $payer_user_id = time().uniqid();
    $data = array(
        'merchant_id' => '10030457',
        'merchant_key' => 'babo764ac4gto',
        'return_url' => base_url('index.php/payment/notify'),
        'cancel_url' => base_url('home/shopping_cart'),
        'notify_url' => base_url('index.php/payment/notify'),
        'name_first' => $user_details['first_name'],
        'name_last' => $user_details['last_name'],
        'email_address' => $user_details['email'],
        'm_payment_id' => $payment_id, // Include 'm_payment_id'
        'amount' => $payment_details['total_payable_amount'],  // Amount in ZAR as a plain number
        'item_name' => 'Your purchased item description',  // Add 
    );

    // Redirect the user to PayFast
    $payfast_url = 'https://sandbox.payfast.co.za/eng/process';
    redirect($payfast_url . '?' . http_build_query($data));
}
///notify

public function notify() {
    
           $this->success_course_payment();
}

public function return() {
    echo 'I am back';
}

// Define a function to fetch the transaction data based on 'm_payment_id'
private function getTransactionData($payment_id) {
    // You need to implement this function in your model (Payment_model)
    // Replace 'Payment_model' with your actual model name
    return $this->Payment_model->get_transaction_by_payment_id($payment_id);
}



    ///

   function success_course_payment(){
        //STARTED payment model and functions are dynamic here
        $response = false;
        $payer_user_id = $this->session->userdata('user_id');
        $enrol_user_id = $payer_user_id;
        $payment_details = $this->session->userdata('payment_details');
        //$payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
       

       
        //ENDED payment model and functions are dynamic here
        
            //if course is a gift purchase
            if($payment_details['gift_to_user_id'] > 0){
                $enrol_user_id = $payment_details['gift_to_user_id'];
                $this->crud_model->enrol_student($enrol_user_id, $payer_user_id);
                //$this->email_model->course_gift_notification($enrol_user_id, $payer_user_id, $payment_method, $payment_details['total_payable_amount']);
            }else{
                $this->crud_model->enrol_student($enrol_user_id);
               // $this->email_model->course_purchase_notification($enrol_user_id, $payment_method, $payment_details['total_payable_amount']);
            }
           // $this->crud_model->course_purchase($payer_user_id, $payment_method, $payment_details['total_payable_amount']);

            $this->session->unset_userdata('gift_to_user_id');
            $this->session->set_userdata('cart_items', array());
            $this->session->set_userdata('payment_details', '');
            $this->session->set_userdata('applied_coupon', '');

            $this->session->set_flashdata('flash_message', site_phrase('payment_successfully_done'));
            redirect('home/my_courses', 'refresh');
    }   
 function success_instructor_payment($payment_method = ""){
        //STARTED payment model and functions are dynamic here
        $user_id = $this->session->userdata('user_id');
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $payment_method])->row_array();
        $model_name = strtolower($payment_gateway['model_name']);
        if($payment_gateway['is_addon'] == 1 && $model_name != null){
            $this->load->model('addons/'.strtolower($payment_gateway['model_name']));
        }
        if($model_name != null){
            $payment_check_function = 'check_'.$payment_method.'_payment';
            $response = $this->$model_name->$payment_check_function($payment_method, 'instructor');
        }else{
            $response = true;
        }
        //ENDED payment model and functions are dynamic here

        if ($response) {
            $this->crud_model->update_payout_status($payment_details['payout_id'], $payment_method);
            $this->session->set_flashdata('flash_message', get_phrase('payout_updated_successfully'));
        }else{
            $this->session->set_flashdata('error_message', site_phrase('an_error_occurred_during_payment'));
        }
        
        redirect(site_url('admin/instructor_payout'), 'refresh');
    }


    function create_stripe_payment($success_url = "", $cancel_url = "", $public_key = "", $secret_key = ""){
        $identifier = 'stripe';
        $payment_details = $this->session->userdata('payment_details');
        $payment_gateway = $this->db->get_where('payment_gateways', ['identifier' => $identifier])->row_array();


        
        //start common code of all payment gateway
        if($payment_details['is_instructor_payout_user_id'] > 0){
            $instructor_details = $this->user_model->get_all_user($payment_details['is_instructor_payout_user_id'])->row_array();
            $keys = json_decode($instructor_details['payment_keys'], true);
            $keys = $keys[$payment_gateway['identifier']];
        }else{
            $keys = json_decode($payment_gateway['keys'], true);
        }
        $test_mode = $payment_gateway['enabled_test_mode'];

        if($test_mode == 1){
            $public_key = $keys['public_key'];
            $secret_key = $keys['secret_key'];
        } else {
            $public_key = $keys['public_live_key'];
            $secret_key = $keys['secret_live_key'];
        }
        //ended common code of all payment gateway

        // Convert product price to cent
        $stripeAmount = round($payment_details['total_payable_amount']*100, 2);

        define('STRIPE_API_KEY', $secret_key);
        define('STRIPE_PUBLISHABLE_KEY', $public_key);
        define('STRIPE_SUCCESS_URL', $payment_details['success_url']);
        define('STRIPE_CANCEL_URL', $payment_details['cancel_url']);

        // Include Stripe PHP library
        require_once APPPATH.'libraries/Stripe/init.php';

        // Set API key
        \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

        $response = array(
            'status' => 0,
            'error' => array(
                'message' => 'Invalid Request!'
            )
        );

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = file_get_contents('php://input');
            $request = json_decode($input);
        }

        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode($response);
            exit;
        }

        // ['name' => 'Course payment']

        if(!empty($request->checkoutSession)){
            // Create new Checkout Session for the order
            try {
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price_data' => [
                            'product_data' => ['name' => $payment_details['payment_title']],
                            'unit_amount' => $stripeAmount,
                            'currency' => $payment_gateway['currency'],
                        ],
                        'quantity' => 1
                    ]],
                    'mode' => 'payment',
                    'success_url' => STRIPE_SUCCESS_URL.'/'.$identifier.'?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => STRIPE_CANCEL_URL,
                ]);
            }catch(Exception $e) {
                $api_error = $e->getMessage();
            }

            if(empty($api_error) && $session){
                $response = array(
                    'status' => 1,
                    'message' => 'Checkout Session created successfully!',
                    'sessionId' => $session['id']
                );
            }else{
                $response = array(
                    'status' => 0,
                    'error' => array(
                        'message' => 'Checkout Session creation failed! '.$api_error
                    )
                );
            }
        }

        // Return response
        echo json_encode($response);
    }


}
