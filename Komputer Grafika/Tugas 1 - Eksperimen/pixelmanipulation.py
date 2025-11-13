import cv2

path = "C:/Users/Utami/Downloads/camp.jpg"
canvas = cv2.imread(path)
if canvas is None:
    print("Gambar tidak ditemukan")
    exit()
canvas = cv2.resize(canvas, (400, 600))

marks = []

def mouse_draw(evt, posX, posY, flags, param):
    global marks, canvas
    if evt == cv2.EVENT_LBUTTONDOWN:
        marks.append((posX, posY))
        print(f"Klik di: {posX}, {posY}")
        if len(marks) == 2:
            color = (0, 0, 255)  # Warna merah (B, G, R)
            cv2.line(canvas, marks[0], marks[1], color, 2)
            print(f"Garis merah dibuat dari {marks[0]} ke {marks[1]}")
            marks.clear()

window = "Line Marker"
cv2.namedWindow(window)
cv2.setMouseCallback(window, mouse_draw)

print("Klik dua titik untuk menggambar garis merah")

while True:
    cv2.imshow(window, canvas)
    key = cv2.waitKey(1) & 0xFF

    if key == 27 or cv2.getWindowProperty(window, cv2.WND_PROP_VISIBLE) < 1:
        print("Program selesai.")
        break
    elif key == ord('r'):
        canvas = cv2.imread(path)
        canvas = cv2.resize(canvas, (400, 600))
        print("Gambar direset.")

cv2.destroyAllWindows()
