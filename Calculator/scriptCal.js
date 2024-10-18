let display = document.getElementById("display");
let currentInput = "";
let operator = ""; // menyimpan operator terakhir yang ditekan
let resultDisplayed = false; // melacak apakah hasil

// Tambah Angka
function appendNumber(number) {
    if (resultDisplayed) {
        display.value = number; 
        resultDisplayed = false;
    } else {
        if (display.value === "0") {
            display.value = number;
        } else {
            display.value += number;
        }
    }
    currentInput += number;
}

// Tambah Tampilan
function appendOperator(op) {
    if (currentInput) {
        if (resultDisplayed) {
            resultDisplayed = false;
        }
        display.value += op;
        operator = op;
        currentInput = "";
    }
}

// Hitung
function calculate() {
    try {
        display.value = eval(display.value); // Menghitung ekspresi matematika
        resultDisplayed = true;
    } catch (error) {
        display.value = "Error";
        currentInput = "";
    }
}

// Hapus Tampilan
function clearDisplay() {
    display.value = "0";
    currentInput = "";
    operator = "";
    resultDisplayed = false;
}

// Hapus Karakter Terakhir
function deleteLast() {
    if (display.value.length > 1) {
        display.value = display.value.slice(0, -1);
    } else {
        display.value = "0";
    }
}
