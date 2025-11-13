#include <iostream>
#include <string>
using namespace std;

// Program FSM untuk menentukan apakah input memiliki 3 angka '1' berturut-turut
int main() {
    string input;
    cout << "=== Finite State Machine: 3 Consecutive 1s ===" << endl;
    cout << "Masukkan string biner (hanya 0 dan 1): ";
    cin >> input;

    // Definisi state
    // S0 = belum ada 1 berturut-turut
    // S1 = 1 berturut-turut
    // S2 = 2 berturut-turut
    // S3 = 3 berturut-turut (accepting state)
    int state = 0;
    bool accepted = false;

    for (char c : input) {
        if (c == '1') {
            if (state == 0) state = 1;
            else if (state == 1) state = 2;
            else if (state == 2) {
                state = 3;
                accepted = true;
                break; // sudah memenuhi 3 berturut-turut
            }
        } else if (c == '0') {
            state = 0; // reset kalau ketemu 0
        } else {
            cout << "Input tidak valid! Hanya boleh 0 atau 1." << endl;
            return 0;
        }
    }

    cout << "\n=== Hasil ===" << endl;
    if (accepted)
        cout << "✅ String diterima: ada tiga angka '1' berturut-turut." << endl;
    else
        cout << "❌ String ditolak: tidak ada tiga angka '1' berturut-turut." << endl;

    return 0;
}
