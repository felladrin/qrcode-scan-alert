# QR Code Scan Alert

PHP script to mail you an alert whenever someone scans your QR Code.

You can generate a QR Code at http://goqr.me/ pointing to `http://example.com/qrcode.jpg` and the htaccess will redirect the visitor to the phpscript. (You can replace `qrcode.jpg` for the filename of your choice, just edit it on the .htaccess)

Also,  on `qrcode.php`, change the mail recipient info and the url to redirect the visitor.

### (Optional) Printing an image instead of redirecting

If you want to show the user an image (jpg, png, gif) instead of redirecting. you can replace on `qrcode.php` the line:
```
header("Location: http://www.example.com/");
```
by the following lines:
```
$base64_image_encoded = '/9j/4Ra...UAf/Z';
header('Cache-Control: max-age=86400');
header('Content-Type: image/jpeg');
exit(base64_decode($base64_image_encoded));
```
Where `$base64_image_encoded` holds the Base64 string of the image. You can convert convert any image in base64 here: [http://base64-image.de](http://base64-image.de)
