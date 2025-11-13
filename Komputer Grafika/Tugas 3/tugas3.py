import matplotlib.pyplot as plt

fig, ax = plt.subplots(figsize=(8, 8))
ax.set_title("DDA - Gambar Garis (Klik 2 titik)", fontsize=14, fontweight='bold')
ax.set_xlim(0, 20)
ax.set_ylim(0, 20)
ax.set_aspect('equal')
ax.grid(True, alpha=0.3)

buffer = []           
artists = []         

def dda_points(x1, y1, x2, y2):
    """Kembalikan daftar titik (integer) hasil algoritma DDA dari (x1,y1) ke (x2,y2)."""
    dx = x2 - x1
    dy = y2 - y1
    steps = int(max(abs(dx), abs(dy)))
    if steps == 0:
        return [(int(round(x1)), int(round(y1)))]
    x_inc = dx / steps
    y_inc = dy / steps
    x, y = x1, y1
    pts = []
    for _ in range(steps + 1):
        pts.append((int(round(x)), int(round(y))))
        x += x_inc
        y += y_inc
    return pts

def onclick(event):
    if event.inaxes != ax or event.xdata is None or event.ydata is None:
        return

    x, y = event.xdata, event.ydata
    p = ax.scatter(x, y, s=80, marker='o', edgecolors='black', zorder=4)
    txt = ax.annotate(f'({int(round(x))}, {int(round(y))})',
                      (x, y), xytext=(5, 5), textcoords='offset points',
                      fontsize=9, color='blue', zorder=5)
    artists.extend([p, txt])

    buffer.append((x, y))
    if len(buffer) == 2:
        (x1, y1), (x2, y2) = buffer
        pts = dda_points(x1, y1, x2, y2)

        xs = [pt[0] for pt in pts]
        ys = [pt[1] for pt in pts]
        pix = ax.scatter(xs, ys, s=180, marker='s', facecolors='red',
                         edgecolors='darkred', zorder=2)
        line, = ax.plot([x1, x2], [y1, y2], linestyle='--', linewidth=1.5,
                        color='black', alpha=0.8, zorder=1)

        artists.extend([pix, line])
        buffer.clear()
        fig.canvas.draw_idle()

def clear_all():
    while artists:
        a = artists.pop()
        try:
            a.remove()
        except Exception:
            pass
    buffer.clear()
    fig.canvas.draw_idle()

def on_key(event):
    if event.key is None:
        return
    if event.key.lower() == 'c':
        clear_all()
    elif event.key.lower() == 'q':
        plt.close(fig)

fig.canvas.mpl_connect('button_press_event', onclick)
fig.canvas.mpl_connect('key_press_event', on_key)

print("="*50)
print("DDA - Interactive")
print("Klik dua titik pada area plot untuk menggambar satu garis.")
print("Tekan 'c' untuk clear, 'q' untuk keluar.")
print("="*50)

plt.show()