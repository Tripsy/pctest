
@extends('layout.general')

@section('content')

<h1>Label / {{ $flag_source }}</h1>

Name: {{ $first_name}} {{ $last_name}} <br />
Company Name: {{ $company_name}} <br />
Full Address: {{ $address_1}} {{ $address_2}} <br />
Phone number: {{ $phone}} <br />
Email: {{ $email}} <br />
Unique identifier: {{ $ident}} <br />

@endsection