import matplotlib.pyplot as plt

def bresenham_circle(cx, cy, r):
    points = []
    x, y = 0, r
    d = 3 - 2 * r  

    def add_points(x, y):
        """Tambahkan 8 titik simetris ke daftar points"""
        sym = [
            (cx + x, cy + y), (cx - x, cy + y),
            (cx + x, cy - y), (cx - x, cy - y),
            (cx + y, cy + x), (cx - y, cy + x),
            (cx + y, cy - x), (cx - y, cy - x)
        ]
        points.extend(sym)

    while x <= y:
        add_points(x, y)
        if d < 0:
            d += 4 * x + 6
        else:
            d += 4 * (x - y) + 10
            y -= 1
        x += 1
    return points

def draw_circle(points, cx, cy, r):
    """Menampilkan lingkaran hasil algoritma Bresenham"""
    x_coords, y_coords = zip(*points)

    plt.figure(figsize=(6, 6))
    plt.scatter(x_coords, y_coords, color='blue', s=20, label='Titik Bresenham')
    plt.scatter(cx, cy, color='red', marker='x', s=100, label='Pusat Lingkaran')

    ref = plt.Circle((cx, cy), r, fill=False, color='red', linestyle='--', alpha=0.6)
    plt.gca().add_patch(ref)

    plt.gca().set_aspect('equal')
    plt.xlim(cx - r - 5, cx + r + 5)
    plt.ylim(cy - r - 5, cy + r + 5)
    plt.grid(alpha=0.3)
    plt.legend()
    plt.title(f"Lingkaran Bresenham (Pusat=({cx}, {cy}), R={r})")
    plt.show()

def main():
    print("=" * 45)
    print("PROGRAM LINGKARAN DENGAN ALGORITMA BRESENHAM")
    print("=" * 45)

    try:
        cx = int(input("Masukkan koordinat X pusat: "))
        cy = int(input("Masukkan koordinat Y pusat: "))
        r = int(input("Masukkan jari-jari: "))

        if r <= 0:
            print("Jari-jari harus lebih besar dari 0!")
            return

        print("\nMenghitung titik-titik lingkaran...")
        points = bresenham_circle(cx, cy, r)
        print(f"Jumlah titik yang dihasilkan: {len(points)}")

        draw_circle(points, cx, cy, r)
        print("\n Lingkaran berhasil digambar!")

    except ValueError:
        print("Masukkan hanya angka!")
    except KeyboardInterrupt:
        print("\n Program dihentikan oleh pengguna.")

if __name__ == "__main__":
    main()