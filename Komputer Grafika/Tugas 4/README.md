# Program Lingkaran Bresenham

Program sederhana untuk menggambar lingkaran menggunakan algoritma Bresenham dengan input dari user.

## Cara Menjalankan

1. Install dependencies yang diperlukan:
```bash
pip install -r requirements.txt
```

2. Jalankan program:
```bash
python lingkaran.py
```

3. Masukkan parameter lingkaran sesuai permintaan:
   - Koordinat X pusat lingkaran
   - Koordinat Y pusat lingkaran  
   - Jari-jari lingkaran

## Fitur Program

- **Algoritma Bresenham**: Menggunakan algoritma Bresenham yang efisien untuk menggambar lingkaran
- **Input User**: User dapat menentukan pusat dan radius lingkaran
- **Visualisasi**: Menampilkan hasil dalam bentuk grafik dengan matplotlib
- **Perbandingan**: Menampilkan lingkaran referensi untuk membandingkan akurasi algoritma
- **Informasi Detail**: Menampilkan jumlah titik yang dihasilkan

## Penjelasan Algoritma

Algoritma Bresenham untuk lingkaran bekerja dengan:
1. Memulai dari titik (0, radius)
2. Menggunakan parameter keputusan `d = 3 - 2*radius`
3. Pada setiap iterasi, memilih antara titik E (East) atau SE (South-East)
4. Memanfaatkan simetri lingkaran untuk menggambar 8 titik sekaligus

## Output

Program akan menampilkan:
- Titik biru: Titik-titik hasil algoritma Bresenham
- Tanda X merah: Pusat lingkaran
- Lingkaran merah putus-putus: Lingkaran referensi untuk perbandingan
- Informasi jumlah titik yang dihasilkan