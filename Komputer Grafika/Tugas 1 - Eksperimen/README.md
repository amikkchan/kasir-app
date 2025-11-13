# Program Pixel Manipulation & Line Drawing

Program sederhana untuk eksperimen komputer grafika yang mencakup manipulasi pixel, algoritma line drawing, dan face detection dengan menggambar kotak di sekitar wajah yang terdeteksi.

## Fitur Program

### 1. Pixel Manipulation
- **Set/Get Pixel**: Mengatur dan mengambil warna pixel pada koordinat tertentu
- **Clear Canvas**: Membersihkan canvas dengan warna background
- **Brightness Adjustment**: Menyesuaikan kecerahan seluruh canvas
- **Contrast Adjustment**: Menyesuaikan kontras seluruh canvas
- **Color Inversion**: Membalik warna seluruh canvas

### 2. Line Drawing Algorithms
- **DDA (Digital Differential Analyzer)**: Algoritma sederhana untuk menggambar garis
- **Bresenham Line Algorithm**: Algoritma efisien untuk menggambar garis
- **Simple Line Equation**: Menggunakan persamaan y = mx + b

### 3. Face Detection & Rectangle Drawing
- **Face Detection**: Menggunakan OpenCV Haar Cascade untuk mendeteksi wajah
- **Rectangle Drawing**: Menggambar kotak merah di sekitar wajah yang terdeteksi
- **Multiple Algorithms**: Menggunakan algoritma line drawing untuk menggambar kotak
- **Output Saving**: Menyimpan hasil dengan nama file yang ditentukan

## Cara Menjalankan Program

### 1. Install Dependencies
```bash
pip install -r requirements.txt
```

### 2. Jalankan Program
```bash
python pixelmanipulation.py
```

### 3. Pilih Demo
Program akan menampilkan menu untuk memilih demo:
- **1**: Pixel Manipulation
- **2**: Line Drawing  
- **3**: Face Detection (menggunakan foto)
- **4**: Semua demo

### 4. Untuk Face Detection
1. Simpan foto dengan nama `foto_wajah.jpg` di folder yang sama dengan program
2. Pilih opsi 3 (Face Detection) dari menu
3. Program akan mendeteksi wajah dan menggambar kotak merah di sekitarnya
4. Hasil akan disimpan dengan nama `Screenshot 2025-10-24 010317_[algorithm].jpg`

## Struktur Program

### Kelas PixelManipulator
- `__init__(width, height)`: Inisialisasi canvas
- `set_pixel(x, y, color)`: Set warna pixel
- `get_pixel(x, y)`: Ambil warna pixel
- `clear_canvas(color)`: Bersihkan canvas
- `adjust_brightness(factor)`: Sesuaikan brightness
- `adjust_contrast(factor)`: Sesuaikan contrast
- `invert_colors()`: Inversi warna
- `show_canvas(title)`: Tampilkan canvas

### Kelas LineDrawer
- `__init__(pixel_manipulator)`: Inisialisasi dengan PixelManipulator
- `draw_line_dda(x1, y1, x2, y2, color)`: Gambar garis dengan DDA
- `draw_line_bresenham(x1, y1, x2, y2, color)`: Gambar garis dengan Bresenham
- `draw_line_simple(x1, y1, x2, y2, color)`: Gambar garis dengan persamaan sederhana

### Kelas FaceDetector
- `__init__()`: Inisialisasi face detector dengan Haar Cascade
- `detect_faces(image_path)`: Deteksi wajah dalam gambar
- `draw_rectangle_on_faces(image_path, output_path, algorithm)`: Gambar kotak di sekitar wajah
- `show_result(image_path, algorithm)`: Tampilkan hasil deteksi wajah

## Contoh Penggunaan

```python
# Buat canvas 300x300
pm = PixelManipulator(300, 300)
pm.clear_canvas((0, 0, 0))  # Background hitam

# Set beberapa pixel
pm.set_pixel(100, 100, (255, 0, 0))  # Pixel merah
pm.set_pixel(150, 150, (0, 255, 0))  # Pixel hijau

# Gambar garis
ld = LineDrawer(pm)
ld.draw_line_dda(50, 50, 250, 200, (255, 255, 255))  # Garis putih

# Tampilkan hasil
pm.show_canvas("Hasil")

# Face Detection
fd = FaceDetector()
fd.draw_rectangle_on_faces("foto_wajah.jpg", "hasil_deteksi.jpg", "bresenham")
```

## Algoritma Line Drawing

### DDA (Digital Differential Analyzer)
- Menghitung increment untuk x dan y berdasarkan jumlah steps
- Cocok untuk garis dengan kemiringan tidak terlalu curam
- Menggunakan floating point arithmetic

### Bresenham Line Algorithm
- Menggunakan integer arithmetic untuk efisiensi
- Menggunakan error term untuk menentukan pixel berikutnya
- Lebih efisien dari DDA

### Simple Line Equation
- Menggunakan persamaan y = mx + b
- Sederhana tetapi kurang efisien
- Cocok untuk pembelajaran konsep dasar

## Output Program

Program akan menampilkan:
1. **Canvas Asli**: Hasil manipulasi pixel dasar
2. **Brightness Adjustment**: Canvas dengan brightness yang disesuaikan
3. **Contrast Adjustment**: Canvas dengan contrast yang disesuaikan
4. **Color Inversion**: Canvas dengan warna terbalik
5. **Line Drawing**: Garis-garis dengan berbagai algoritma
6. **Perbandingan Algoritma**: Garis yang sama dengan algoritma berbeda
7. **Face Detection**: Foto dengan kotak merah di sekitar wajah yang terdeteksi
8. **Saved Files**: File hasil dengan nama `Screenshot 2025-10-24 010317_[algorithm].jpg`

## Catatan Penting

- Koordinat menggunakan sistem (x, y) dengan (0,0) di kiri atas
- Warna menggunakan format RGB dengan nilai 0-255
- Program menggunakan matplotlib untuk visualisasi
- Semua operasi pixel dilakukan dalam memori sebelum ditampilkan

## Troubleshooting

Jika terjadi error:
1. Pastikan numpy, matplotlib, dan opencv-python sudah terinstall
2. Pastikan Python versi 3.6 atau lebih baru
3. Jika matplotlib tidak menampilkan plot, coba jalankan dengan backend yang berbeda

```python
import matplotlib
matplotlib.use('TkAgg')  # atau 'Qt5Agg'
```

4. Untuk Face Detection:
   - Pastikan file `foto_wajah.jpg` ada di folder yang sama
   - Pastikan foto memiliki wajah yang jelas dan terang
   - Jika tidak ada wajah yang terdeteksi, coba foto dengan pencahayaan yang lebih baik
   - Pastikan OpenCV dapat mengakses Haar Cascade classifier
