<?php

include 'array.php';

// echo "<pre>"; print_r($documents); exit;

$only_case_numbers = [];
foreach ($documents as $key => $value) {
	$only_case_numbers[$value['case_number']] = $key;
}

// echo "<pre>"; print_r($only_case_numbers); exit;
$newArray = [];

$total_debit_amount = 0;
$total_credit_amount = 0;
foreach ($documents as $key => $value) {
	// echo "<pre>"; print_r($value);
	$data = [];
	// $previous_case_number = $value['case_number'];
	// if ($key == 0) {
	// 	$previous_case_number = $value['case_number'];
	// 	$current_case_number = $value['case_number'];
	// } else {
	// 	$previous_case_number = $current_case_number;
	// 	$current_case_number = $value['case_number'];
	// }

	$data = array(
		'Case Number' => $value['case_number'],
		'Doct Type' => $value['doct_type'],
		'Total Debit' => $value['debit_balance'], 
		'Total Credit' => $value['credit_balance'], 
	);

	if (!empty($data)) {
		$newArray[] = $data;
	}

	$total_debit_amount += $value['debit_balance'];
	$total_credit_amount += $value['credit_balance'];
	
	if ($key == $only_case_numbers[$value['case_number']]) {
	// if ($current_case_number != $previous_case_number) {
		// $data[$key] = array(
		// 	'Case Number' => $value['case_number'],
		// 	'Doct Type' => $value['doct_type']
		// );

		$total_open_balance = $total_debit_amount + $total_credit_amount;
		$totalarray = array(
			'Case Number' => $value['case_number'],
			'Doct Type' => 'Grand Total', 
			'Total Debit' => $total_debit_amount, 
			'Total Credit' => $total_credit_amount, 
			'Open Balance' => $total_open_balance, 
		);
		// $totalarray['Case Number'] = $value['case_number']; 
		// $totalarray['Doct Type'] = 'Grand Total'; 

		array_push($newArray, $totalarray);

	}


	// echo "<pre>"; print_r($previous_case_number);
}

// echo "<pre>"; print_r(count($newArray)); exit;
echo "<pre>"; print_r($newArray); exit;