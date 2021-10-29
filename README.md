# Sistem Inventory Harno-Mart berbasis web

Merupakan sistem CRUD pengolahan data barang sederhana berbasis web, dengan menggunakan framework CodeIgniter-4 dan menggunakan konsep MVC (Model View Controller).

Sistem dapat menampilkan data stok barang yang ada berdasarkan transaksi barang masuk dan barang keluar gudang. Terdapat tiga warna pada kolom stok yang mengidentifikasi ketersedian dari setiap barang, warna merah menandakan stok barang dalam keadaan menipis, warna hijau menandakan stok barang dalam keadaan aman dan warna kuning menandakan stok barang dalam keadaan berlebih. 

Sistem dapat melakukan pengolahan data seperti :
- Pengolahan data Supplier atau Pemasok
- Pengolahan data Kategori Barang
- Pengolahan data Barang
- Pengolahan data Barang Masuk
- Pengolahan data Barang Keluar
- Pengolahan data User


# Tampilan Sistem

- Halaman Login

  ![HM-login](https://user-images.githubusercontent.com/92847512/139365143-bd316d7a-8049-4939-a05b-b1058fd5b373.png)

- Halaman Dashboard

  ![HM-dashboard](https://user-images.githubusercontent.com/92847512/139365181-fd0d25eb-9bb9-42e4-a41a-087a33bc4b88.png)

- Halaman Stok Barang

  ![HM-databrg](https://user-images.githubusercontent.com/92847512/139365275-0f70be4f-bf79-4720-b04f-6a7ec33a57ba.png)

- Halaman Tambah Data Barang

  ![HM-inputbrg](https://user-images.githubusercontent.com/92847512/139366094-f821c1c2-1ff5-4715-b201-8ea52fe1afe1.png)
  
- Halaman Tambah Barang Masuk

  ![HM-inpbrgmasuk](https://user-images.githubusercontent.com/92847512/139366356-ee3a6976-a399-4f48-9f43-682914b684a0.png)



# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
