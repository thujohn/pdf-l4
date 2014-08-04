# Dompdf

Simple Dompdf package for Laravel 4
This package uses the latest stable version (0.5)

[![Build Status](https://travis-ci.org/thujohn/pdf-l4.png?branch=master)](https://travis-ci.org/thujohn/pdf-l4)


## Installation

Add `thujohn/pdf` to `composer.json`.
```
"thujohn/pdf": "dev-master"
```
    
Run `composer update` to pull down the latest version of Pdf.

Now open up `app/config/app.php` and add the service provider to your `providers` array.
```php
'providers' => array(
	'Thujohn\Pdf\PdfServiceProvider',
)
```
Now add the alias.
```php
'aliases' => array(
	'PDF' => 'Thujohn\Pdf\PdfFacade',
)
```
Publish the config
```
php artisan config:publish thujohn/pdf
```


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

Multiple PDFs
```php
for ($i=1;$i<=2;$i++)
{
	$pdf = new \Thujohn\Pdf\Pdf();
	$content = $pdf->load(View::make('pdf.image'))->output();
	File::put(public_path('test'.$i.'.pdf'), $content);
}
PDF::clear();
```


## Examples

Save the PDF to a file in a specific folder, and then mail it as attachement.
By @w0rldart

```php
define('BUDGETS_DIR', public_path('uploads/budgets')); // I define this in a constants.php file

if (!is_dir(BUDGETS_DIR)){
	mkdir(BUDGETS_DIR, 0755, true);
}

$outputName = str_random(10); // str_random is a [Laravel helper](http://laravel.com/docs/helpers#strings)
$pdfPath = BUDGETS_DIR.'/'.$outputName.'.pdf';
File::put($pdfPath, PDF::load($view, 'A4', 'portrait')->output());

Mail::send('emails.pdf', $data, function($message) use ($pdfPath){
	$message->from('us@example.com', 'Laravel');
	$message->to('you@example.com');
	$message->attach($pdfPath);
});
```
