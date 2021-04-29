@component('mail::message')
# Skill Shop Request

<strong><u>System Id</u></strong> <br>
{{ $sysid ?? '' }}

<strong><u>Product Name</u></strong> <br>
{{ $productName ?? '' }}

<strong><u>Overview</u></strong> <br>
{{ $overview ?? '' }}

<strong><u>Selected Courses</u></strong> <br>
{{-- {{ $selectedCourses }} --}}

<strong><u>Price Points:</u></strong> <br>
{{-- @foreach ($pricePoints ?? '' as $pricePoint)
Price Point : {{ $pricePoint['price'] }}
Payment Option : {{ $pricePoint['term'] }} 
Pricing Model: {{ $pricePoint['priceModel'] }}
    
@endforeach --}}

<strong><u>Subject Matter Expert</u></strong> <br>
{{ $sme ?? '' }}

<strong><u>Bio</u></strong> <br>
{{ $bio ?? '' }}

<strong><u>Image Link</u></strong> <br>
{{ $imgLink ?? '' }}



Thanks,<br>
{{ config('app.name') }}
@endcomponent