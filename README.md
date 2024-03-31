# Introduction 

This is a simple guide on how to integrate Hydrogen Payment Gateway into your PHP application.

# Getting Started

The following steps will guide you through integrating the provided code sample into your PHP application to create a seamless payment gateway experience.

1.	Integration steps 1: Set Up Your Hydrogen Payment Gateway Account

    1.  Visit the Hydrogen website and create an account (https://dashboard.hydrogenpay.com/).

    2.  Obtain your Authentication Key

2.	steps 2: Integrate the Payment Form

    1.  Copy the index.php code and paste it into your project's file, e.g., payment_form.php..

    2.  Ensure the Bootstrap CSS and JS files are included in your project.

    3.  Make sure to update the API_URL constant in processPayment.php file with the appropriate endpoint URL for your environment, either QA or    PROD, to initiate payment.

    4.  Update the AUTH_KEY constant in the processPayment.php file with your Authentication key (Test key or Prod).

    5.  Customize the form fields as needed for your application.

3.	steps 3: Process the Payment

    1.  When a user submits the payment form, the data is sent to processPayment.php.

    2.  The PHP script uses cURL to send a request to the Hydrogen Payment API with the payment details.

    3.  If the payment initiation is successful, the script redirects the user to the payment link provided by the API.

4.	steps 4: Verify the Payment

    1.  After the user completes the payment, they are redirected back to your website, specifically to verifyPayment.php.

    2.  The script in verifyPayment.php verifies the payment status by sending a request to the Hydrogen Payment API with the transaction reference.

    3.  If the payment is successful, it displays the payment details. Otherwise, it shows an error message.

#	API references

    * https://dashboard.hydrogenpay.com/

    * https://docs.hydrogenpay.com/docs/authentication


# Request Parameters

| Mandatory | Name        | Comment                                               |
|-----------|-------------|-------------------------------------------------------|
| Yes       | amount      | The amount to be charged for the transaction.         |
| Yes       | email       | The customer's email address.                         |
| Yes       | currency    | The currency in which the transaction is processed.   |
| No       | description | A brief description of the transaction.               |
| No       | meta        | Additional metadata or information related to the transaction. |
| Yes       | callback    | Callback redirection
| No       | isAPI       | A boolean indicating whether the transaction is initiated via API (true/false). |

## Status Codes

### Initiate Payment

| Status Code | Type   | Description                               |
|-------------|--------|-------------------------------------------|
| 90000       | Custom | Initiate payment Saved successfully       |
| 10001       | Custom | An error occurred                         |
| 10002       | Custom | Callback is required                      |
| 10002       | Custom | Email is required                          |
| 10002       | Custom | Invalid currency                          |
| 10005       | Custom | This client transaction ref already exists|

### Confirm Payment

| Status Code | Type   | Description                           |
|-------------|--------|---------------------------------------|
| 10001       | Custom | An error occurred                     |
| 10002       | Custom | Invalid transactionId                 |
| 9000        | Custom | Successful transaction                |


# Contribute
TODO: Explain how other users and developers can contribute to make your code better. 

If you discover a bug or have a solution to improve the Payment Gateway for Hydrogen,
we welcome your contributions to enhance the code.

 * Visit our GitHub repository: [https://github.com/HydrogenAfrica/php-integration]

 * Create a detailed bug report or feature request in the "Issues" section.

 * If you have a code improvement or bug fix, feel free to submit a pull request.

        * Fork the repository on GitHub

        * Clone the repository into your local system and create a branch that describes what you are working on by pre-fixing with feature-name.

        * Make the changes to your forked repository's branch. Ensure you are using PHP Coding Standards (PHPCS).

        * Make commits that are descriptive and breaks down the process for better understanding.

        * Push your fix to the remote version of your branch and create a PR that aims to merge that branch into master.
        
        * After you follow the step above, the next stage will be waiting on us to merge your Pull Request.
        
 Your contributions help us make the PG plugin even better for the community. Thank you!

