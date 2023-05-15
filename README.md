<h1 align="center">Selamat datang di Sistem Monitoring Pasang Surut Air Laut! 👋</h1>

## Latar Belakang:

Pasang surut air laut merupakan naik atau turunnya posisi permukaan perairan laut yang disebabkan oleh pengaruh gaya gravitasi bulan dan matahari. Pasang surut air laut menyebabkan perubahan kedalaman perairan dan mengakibatkan arus pusaran yang dikenal sebagai arus pasang, sehingga perkiraan kejadian pasang sangat diperlukan dalam navigasi laut.

## Sistem Kinerja

Sistem Monitoring Pasang Surut Air Laut Berbasis Internet of Things yang dibangun dengan mikrokontroller NodeMcu ESP8266 yaitu berbasis web service, perangkat keras sehingga pengontrolan dapat dilakukan secara realtime dan online melalui sebuah halaman webste. Mikrokontroller dirancang untuk diterapkan langsung untuk keperluan pemantauan pasang surut air laut. Sistem yang dibuat menggunakan NodeMcu ESP8266 sebagai pengolah data dan sensor ultrasonik sebagai sensor ketinggiannnya. Sistem ini juga dapat menyediakan informasi tentang tinggi air laut.

## Fitur tersedia

**Website** 
- Landing Page 
- Login Page 
- Master Data Monitoring Air Laut 
- Report Data Monitoring filter tanggal

**Alat** 
- Menampilkan Data ketinggian Air laut pada LCD 
- Buzzer berbunyi apabila Air laut melebihi batas yang ditentukan 
- Led menyala jika terjadi gelombang air tinggi sebagai penanda bahaya

## Sensor dan Peralatan Pendukung

**Hardware**

-   NodeMcu ESP8266
-   Sensor Ultrasonic
-   Buzzer
-   Led
-   LCD 16x2

**Software**

-   Arduino IDE
-   Visual Studio Code
-   Framework Laravel Versi 10

---

## Release Date

**Release date : 15 Mei 2023**

> Sistem Monitoring Pasang Surut Air Laut merupakan project open source yang dibuat karena adanya permintaan. dan dapat dikembangkan sewaktu-waktu. Terima kasih!

---

## Default Account for testing

**Admin Default Account**

-   email: admin@gmail.com
-   Password: 12345678

---

## Install

1. **Clone Repository**

```bash
https://github.com/vikarmaulanaarrisyad/monitoring-pasang-surut-air-laut-web.git
cd monitoring-pasang-surut-air-laut-web
composer install
cp .env.example .env
```

2. **Buka `.env` lalu ubah baris berikut sesuai dengan databasemu yang ingin dipakai**

```bash
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. **Instalasi website**

```bash
php artisan key:generate
php artisan migrate --seed
```

4. **Jalankan website**

```bash
php artisan serve
```

## Author

-   Facebook : <a href="https://web.facebook.com/viikar.arrisyad.7/"> Vikar Maulana</a>
-   Instagram : <a href="https://www.instagram.com/vikar_maulana_/"> Vikar Maulana</a>

## Contributing

Contributions, issues and feature requests di persilahkan.
Jangan ragu untuk memeriksa halaman masalah jika Anda ingin berkontribusi. **Berhubung Project ini masih saya kembangkan sendiri, namun banyak fitur yang kalian dapat tambahkan silahkan berkontribusi yaa!**

## License

-   Copyright © 2023 Vikar Maulana.
-   **Sistem Monitoring Pasang Surut Air Laut is open-sourced software licensed under the MIT license.**
