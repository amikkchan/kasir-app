import matplotlib.pyplot as plt

fig, ax = plt.subplots(figsize=(10, 8))
ax.set_title("Algoritma Brute Force - Pembuatan Garis",
             fontsize=14, fontweight='bold')
ax.set_xlim(0, 20)
ax.set_ylim(0, 20)
ax.set_aspect('equal')
ax.grid(True, alpha=0.3)

temp_points = []   
artists_to_remove = []

def brute_force_pixels(x1, y1, x2, y2):
    x1_i, y1_i = int(round(x1)), int(round(y1))
    x2_i, y2_i = int(round(x2)), int(round(y2))

    if x1_i > x2_i:
        x1_i, y1_i, x2_i, y2_i = x2_i, y2_i, x1_i, y1_i

    pixels = []
    dx = x2_i - x1_i
    dy = y2_i - y1_i

    if dx != 0:
        m = dy / dx
        for x in range(x1_i, x2_i + 1):
            y = y1_i + m * (x - x1_i)
            pixels.append((x, int(round(y))))
    else:
        step = 1 if y2_i > y1_i else -1
        for y in range(y1_i, y2_i + step, step):
            pixels.append((x1_i, y))
    return pixels

def onclick(event):
    if event.inaxes != ax or event.xdata is None or event.ydata is None:
        return

    x, y = event.xdata, event.ydata
    temp_points.append((x, y))

    p = ax.scatter(x, y, s=100, marker='o', edgecolors='black', zorder=4)
    a = ax.annotate(f'({int(round(x))}, {int(round(y))})',
                    (x, y), xytext=(5, 5), textcoords='offset points',
                    fontsize=9, color='blue', zorder=5)
    artists_to_remove.extend([p, a])

    if len(temp_points) == 2:
        (x1, y1), (x2, y2) = temp_points

        pixels = brute_force_pixels(x1, y1, x2, y2)

        xs = [px for px, py in pixels]
        ys = [py for px, py in pixels]
        pix_artist = ax.scatter(xs, ys, s=200, marker='s',
                                facecolors='red', edgecolors='darkred', zorder=2)
        artists_to_remove.append(pix_artist)

        line_artist, = ax.plot([x1, x2], [y1, y2],
                               linestyle='--', linewidth=2, color='black', zorder=1)
        artists_to_remove.append(line_artist)

        fig.canvas.draw_idle()
        temp_points.clear()  

def clear_all():
    while artists_to_remove:
        artist = artists_to_remove.pop()
        try:
            artist.remove()
        except Exception:
            pass
    temp_points.clear()
    fig.canvas.draw_idle()

def on_key(event):
    if event.key is None:
        return
    if event.key.lower() == 'c':
        clear_all()

fig.canvas.mpl_connect('button_press_event', onclick)
fig.canvas.mpl_connect('key_press_event', on_key)

print("=" * 60)
print("ALGORITMA BRUTE FORCE - PEMBUATAN BANYAK GARIS (Sederhana)")
print("Cara pakai:")
print(" - Klik dua titik pada area plot untuk membuat satu garis.")
print(" - Ulangi (klik dua titik) untuk membuat garis lain sebanyak yang kamu mau.")
print(" - Tekan 'c' untuk membersihkan semua dan mulai ulang.")
print("=" * 60)

plt.show()