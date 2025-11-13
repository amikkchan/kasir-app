#include <iostream>
#include <string>

// ## 1. Mendefinisikan Semua State yang Mungkin
// Menggunakan enum class agar lebih aman dan jelas.
enum class State {
    Q0, // State Awal: belum menemukan '1' atau urutan terputus.
    Q1, // State setelah menemukan satu '1'.
    Q2, // State setelah menemukan dua '1' berurutan ("11").
    Q3  // State Final/Penerima: telah menemukan "111".
};

// ## 2. Membuat Class untuk Mesin FSM
class DetectorFSM {
private:
    // Variabel untuk menyimpan state mesin saat ini.
    State currentState;

    // Fungsi helper untuk mengubah enum State menjadi string agar mudah dibaca.
    std::string stateToString(State state) const {
        switch (state) {
            case State::Q0: return "Q0 (Awal)";
            case State::Q1: return "Q1 (Melihat '1')";
            case State::Q2: return "Q2 (Melihat '11')";
            case State::Q3: return "Q3 (Menemukan '111')";
            default:        return "State Tidak Dikenal";
        }
    }

public:
    // Constructor: Saat mesin dibuat, state awalnya adalah Q0.
    DetectorFSM() : currentState(State::Q0) {}

    // Metode untuk memproses satu karakter dan mengubah state sesuai aturan.
    void processChar(char input) {
        // Logika transisi diimplementasikan menggunakan switch-case.
        switch (currentState) {
            case State::Q0:
                if (input == '1') {
                    currentState = State::Q1;
                }
                // Jika input '0', tetap di Q0 (tidak perlu ditulis eksplisit).
                break;

            case State::Q1:
                if (input == '1') {
                    currentState = State::Q2;
                } else { // Jika input '0'
                    currentState = State::Q0;
                }
                break;

            case State::Q2:
                if (input == '1') {
                    currentState = State::Q3; // Sukses!
                } else { // Jika input '0'
                    currentState = State::Q0;
                }
                break;

            case State::Q3:
                // Jika sudah di state Q3, tetap di Q3 apapun inputnya.
                // Tidak perlu melakukan apa-apa.
                break;
        }
    }

    // Metode untuk memeriksa apakah mesin berada di state penerima/final.
    bool hasFoundSequence() const {
        return currentState == State::Q3;
    }

    // Metode untuk mendapatkan state saat ini dalam bentuk string.
    std::string getCurrentStateString() const {
        return stateToString(currentState);
    }
};

// ## 3. Fungsi main() sebagai Driver Program
int main() {
    // Membuat objek dari mesin FSM kita.
    DetectorFSM machine;
    std::string inputString;

    // Meminta input dari pengguna.
    std::cout << "## Program Detektor Urutan '111' ##" << std::endl;
    std::cout << "Masukkan string biner (contoh: 1011101): ";
    std::cin >> inputString;

    std::cout << "\n--- Proses Pengecekan State ---" << std::endl;
    std::cout << "State awal: " << machine.getCurrentStateString() << std::endl;

    // Loop melalui setiap karakter dalam string input.
    for (char const &c : inputString) {
        machine.processChar(c);
        std::cout << "Setelah memproses '" << c << "' -> State sekarang: " << machine.getCurrentStateString() << std::endl;
    }

    // Menampilkan hasil akhir setelah semua input diproses.
    std::cout << "\n--- Hasil Akhir ---" << std::endl;
    if (machine.hasFoundSequence()) {
        std::cout << "? String '" << inputString << "' mengandung '111'." << std::endl;
    } else {
        std::cout << "? String '" << inputString << "' TIDAK mengandung '111'." << std::endl;
    }

    return 0;
}