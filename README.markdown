Autosmush
=========

[Read the introductory blog post](http://clickontyler.com/blog/2010/10/automatically-compressing-your-amazon-s3-images-using-yahoos-smush-it-service/).

Autosmush is a command line tool which scans an [Amazon S3](http://aws.amazon.com/s3/) bucket
and losslessly compresses your images using Yahoo!'s amazing
[Smush.it web service](http://developer.yahoo.com/yslow/smushit/). It also adds a far-future
expires header on your images to aid in browser caching as recommended by
[YSlow](http://developer.yahoo.com/yslow/).

Autosmush can be run manually or as a cron job. It avoids re-smushing images by checking for an
'x-amz-smushed' HTTP header on already processed images.

FEATURES
--------

 * Smushed images are automatically re-uploaded into S3
 * Avoids re-smushing images, so future runs take less time
 * Pass the '-t' parameter to do a dry-run and see how much space you could be saving
 * Adds far future expiration header to each file
 * Prints a summary of total bytes saved when complete

REQUIREMENTS
------------

 * Requires PHP5 and php_curl extension.
 * Requires the 1.6.x [AWS SDK for PHP](https://github.com/amazonwebservices/aws-sdk-for-php/releases). (Download and install instructions are located inside autosmush.)

USAGE
-----

`./autosmush some-s3-bucket-name`

or

`./autosmush some-s3-bucket-name/path/to/files`


UPDATES
-------

Code is hosted at GitHub: [http://github.com/tylerhall/autosmush](http://github.com/tylerhall/autosmush)

LICENSE
-------

The MIT License

Copyright (c) 2010 Tyler Hall <tylerhall AT gmail DOT com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
