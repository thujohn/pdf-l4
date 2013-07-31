# Dompdf

Simple Dompdf package for Laravel 4

[![Build Status](https://travis-ci.org/thujohn/pdf-l4.png?branch=master)](https://travis-ci.org/thujohn/pdf-l4)


## Installation

Add `thujohn/pdf` to `composer.json`.

    "thujohn/pdf": "dev-master"
    
Run `composer update` to pull down the latest version of Pdf.

Now open up `app/config/app.php` and add the service provider to your `providers` array.

    'providers' => array(
        'Thujohn\Pdf\PdfServiceProvider',
    )

Now add the alias.

    'aliases' => array(
        'PDF' => 'Thujohn\Pdf\PdfFacade',
    )


## Usage

Show a PDF

```php
Route::get('/', function()
{
	$html = '<html><body>'
			. '<p>Put your html here, or generate it with your favourite '
			. 'templating system.</p>'
			. '</body></html>';
	return PDF::load($html, 'A4', 'portrait')->show();
});
```

Download a PDF

```php
Route::get('/', function()
{
	$html = '<html><body>'
			. '<p>Put your html here, or generate it with your favourite '
			. 'templating system.</p>'
			. '</body></html>';
	return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
});
```

Returns a PDF as a string

```php
Route::get('/', function()
{
	$html = '<html><body>'
			. '<p>Put your html here, or generate it with your favourite '
			. 'templating system.</p>'
			. '</body></html>';
	$pdf = PDF::load($html, 'A4', 'portrait')->output();
});
```
