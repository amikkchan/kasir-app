import matplotlib.pyplot as plt

def bresenham_line(x1, y1, x2, y2):
    """
    Menggambar garis menggunakan algoritma Bresenham.
    Menghasilkan daftar titik (x, y) di antara (x1, y1) dan (x2, y2).
    """
    points = [] 

    dx = abs(x2 - x1)
    dy = abs(y2 - y1)
    sx = 1 if x1 < x2 else -1  
    sy = 1 if y1 < y2 else -1  
    err = dx - dy

    while True:
        points.append((x1, y1))  
        if x1 == x2 and y1 == y2:  
            break
        e2 = 2 * err
        if e2 > -dy:
            err -= dy
            x1 += sx
        if e2 < dx:
            err += dx
            y1 += sy
    return points

def draw_line(points, x1, y1, x2, y2):
    """Menampilkan garis hasil algoritma Bresenham"""
    x_coords, y_coords = zip(*points)

    plt.figure(figsize=(6, 6))
    plt.scatter(x_coords, y_coords, color='blue', s=30, label='Titik Bresenham')
    plt.plot([x1, x2], [y1, y2], color='red', linestyle='--', label='Garis Referensi')
    plt.scatter([x1, x2], [y1, y2], color='green', s=80, marker='x', label='Titik Awal & Akhir')

    plt.title(f"Garis Bresenham dari ({x1}, {y1}) ke ({x2}, {y2})")
    plt.xlabel("X")
    plt.ylabel("Y")
    plt.grid(alpha=0.3)
    plt.legend()
    plt.gca().set_aspect('equal')
    plt.show()

def main():
    print("=" * 40)
    print("PROGRAM GARIS DENGAN ALGORITMA BRESENHAM")
    print("=" * 40)

    try:
        x1 = int(input("Masukkan X1: "))
        y1 = int(input("Masukkan Y1: "))
        x2 = int(input("Masukkan X2: "))
        y2 = int(input("Masukkan Y2: "))

        print("\nMenghitung titik-titik garis...")
        points = bresenham_line(x1, y1, x2, y2)
        print(f"Jumlah titik: {len(points)}")

        draw_line(points, x1, y1, x2, y2)
        print("\n Garis berhasil digambar!")

    except ValueError:
        print("Masukkan hanya angka!")
    except KeyboardInterrupt:
        print("\n Program dihentikan oleh pengguna.")

if __name__ == "__main__":
    main()