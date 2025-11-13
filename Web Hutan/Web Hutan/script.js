// ===== GLOBAL VARIABLES =====
let currentQuestionIndex = 0;
let score = 0;
const quizQuestions = [
    {
        question: "Berapa persen penyebab utama deforestasi di Indonesia?",
        options: [
            "20% karena penebangan liar",
            "40% karena industri kelapa sawit",
            "30% karena kebakaran hutan",
            "10% karena pembangunan infrastruktur"
        ],
        answer: "40% karena industri kelapa sawit",
        explanation: "Industri kelapa sawit adalah penyebab terbesar deforestasi di Indonesia, berkontribusi sekitar 40% dari total kehilangan hutan."
    },
    {
        question: "Berapa banyak spesies terancam punah di Indonesia menurut IUCN Red List?",
        options: ["500 spesies", "650 spesies", "700 spesies", "772 spesies"],
        answer: "772 spesies",
        explanation: "Menurut IUCN Red List, Indonesia memiliki 772 spesies terancam punah, termasuk 140 burung, 63 mamalia, dan 21 reptil."
    },
    {
        question: "Apa dampak utama deforestasi terhadap keanekaragaman hayati?",
        options: [
            "Peningkatan jumlah spesies baru",
            "Hilangnya habitat alami satwa liar",
            "Penambahan populasi satwa",
            "Meningkatkan keragaman genetik"
        ],
        answer: "Hilangnya habitat alami satwa liar",
        explanation: "Deforestasi menyebabkan hilangnya habitat alami, yang merupakan penyebab utama (80%) kepunahan spesies."
    },
    {
        question: "Berapa luas hutan Indonesia yang hilang pada tahun 2024?",
        options: ["150.000 hektar", "261.575 hektar", "300.000 hektar", "200.000 hektar"],
        answer: "261.575 hektar",
        explanation: "Indonesia kehilangan 261.575 hektar hutan primer pada tahun 2024, menunjukkan tren yang mengkhawatirkan."
    },
    {
        question: "Bagaimana cara individu dapat berkontribusi mengurangi deforestasi?",
        options: [
            "Membeli semua produk tanpa sertifikasi",
            "Menggunakan lebih banyak kertas",
            "Membeli produk dengan sertifikasi RSPO dan FSC",
            "Tidak ada yang bisa dilakukan individu"
        ],
        answer: "Membeli produk dengan sertifikasi RSPO dan FSC",
        explanation: "Dengan membeli produk bersertifikasi RSPO dan FSC, kita mendukung praktik ramah lingkungan."
    }
];

const speciesData = {
    orangutan: {
        name: "Orangutan",
        emoji: "🦧",
        status: "Sangat Terancam",
        population: "~104.700",
        location: "Kalimantan & Sumatra",
        threats: ["Perkebunan sawit", "Kebakaran hutan", "Perburuan", "Perdagangan ilegal"],
        facts: [
            "Kehilangan 80% habitat dalam 20 tahun terakhir",
            "95% DNA sama dengan manusia",
            "Dapat hidup hingga 60 tahun di alam liar"
        ],
        conservation: "Program reintroduksi, hutan lindung, patroli anti-braconing"
    },
    tiger: {
        name: "Harimau Sumatra",
        emoji: "🐅",
        status: "Terancam Punah",
        population: "~400-500",
        location: "Sumatra",
        threats: ["Perburuan untuk kulit", "Hilangnya habitat", "Konflik dengan manusia"],
        facts: [
            "Harimau Jawa & Bali sudah punah",
            "Membutuhkan 5-7 kg daging per hari",
            "Territory jantan mencapai 100 km²"
        ],
        conservation: "Taman Nasional, penegakan hukum, program breeding"
    },
    rhino: {
        name: "Badak Jawa",
        emoji: "🦏",
        status: "Sangat Kritis",
        population: "~75",
        location: "Taman Nasional Ujung Kulon",
        threats: ["Hilangnya habitat", "Penyakit", "Perburuan untuk cula", "Tsunami"],
        facts: [
            "Salah satu mamalia paling langka di dunia",
            "Hanya ada di TN Ujung Kulon, Banten",
            "Ujung cula terbuat dari keratin"
        ],
        conservation: "Konservasi habitat, teknologi reproduksi IVF"
    },
    elephant: {
        name: "Gajah Sumatra",
        emoji: "🐘",
        status: "Terancam",
        population: "~2.400-2.800",
        location: "Sumatra",
        threats: ["Fragmentasi habitat", "Konflik dengan manusia", "Perburuan gading"],
        facts: [
            "Lebih kecil dari gajah Asia lainnya",
            "Hamil selama 22 bulan",
            "Memiliki memori yang sangat kuat"
        ],
        conservation: "Jalur migrasi gajah, patroli anti-braconing"
    },
    bird: {
        name: "Cendrawasih",
        emoji: "🦜",
        status: "Terancam",
        population: "Beragam",
        location: "Papua & Papua Barat",
        threats: ["Perburuan untuk bulu", "Perdagangan ilegal", "Hilangnya habitat hutan"],
        facts: [
            "42 spesies cendrawasih di Papua",
            "Dijuluki Bird of Paradise",
            "Ritual kawin yang sangat unik"
        ],
        conservation: "Penyadartahuan masyarakat, ekowisata"
    },
    bear: {
        name: "Beruang Madu",
        emoji: "🐻",
        status: "Rentan",
        population: "Tidak pasti",
        location: "Kalimantan & Sumatra",
        threats: ["Hilangnya habitat", "Perburuan", "Konflik dengan manusia"],
        facts: [
            "Satu-satunya beruang di Asia Tenggara",
            "Pendaki pohon yang sangat baik",
            "Dapat hidup hingga 30 tahun"
        ],
        conservation: "Konservasi habitat, patroli hutan"
    }
};

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    initializeScrollAnimations();
    initializeNavigation();
    initializeTabs();
    initializeQuiz();
    initializeCounters();
    initializeCharts();
    initializeScrollToTop();
    displayQuestion();
});

function initializeScrollAnimations() {
    const fadeElements = document.querySelectorAll('.fade-in');
    const appearOnScroll = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
    }, { threshold: 0.1 });
fadeElements.forEach(el => appearOnScroll.observe(el));
}

function initializeNavigation() {
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id]');
    
    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
    
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetTab = button.getAttribute('data-tab');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            button.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
    
    const solTabs = document.querySelectorAll('.sol-tab');
    const solContents = document.querySelectorAll('.sol-content');
    
    solTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetSol = tab.getAttribute('data-sol');
            solTabs.forEach(t => t.classList.remove('active'));
            solContents.forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(targetSol).classList.add('active');
        });
    });
    
    // Game tabs
    const gameTabs = document.querySelectorAll('.game-tab');
    const gameContents = document.querySelectorAll('.game-content');
    
    gameTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetGame = tab.getAttribute('data-game');
            gameTabs.forEach(t => t.classList.remove('active'));
            gameContents.forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(targetGame).classList.add('active');
        });
    });
}

function initializeQuiz() {
    const nextBtn = document.getElementById('next-btn');
    const finishBtn = document.getElementById('finish-btn');
    
    if (nextBtn) nextBtn.addEventListener('click', nextQuestion);
    if (finishBtn) finishBtn.addEventListener('click', showResults);
}

function initializeCounters() {
    const observer = new IntersectionObserver((entries) => {
        if (entries.some(e => e.isIntersecting)) {
            animateCounters();
        }
    }, { threshold: 0.5 });
    
    const statCards = document.querySelectorAll('.data-card, .hero-stat');
    statCards.forEach(card => observer.observe(card));
}

function animateCounters() {
    const counters = document.querySelectorAll('.stats-number, .stat-number');
    counters.forEach(counter => {
        const target = parseFloat(counter.getAttribute('data-target'));
        if (isNaN(target)) return;
        
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = (target % 1 !== 0) ? current.toFixed(3) : Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = (target % 1 !== 0) ? target.toFixed(3) : target;
            }
        };
        updateCounter();
    });
}

function initializeCharts() {
    const forestCtx = document.getElementById('forestChart');
    if (forestCtx) {
        new Chart(forestCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'Hutan Hilang (Hektar)',
                    data: [260000, 230000, 200000, 220000, 240000, 200000, 230000, 250000, 240000, 261575],
                    borderColor: '#388e3c',
                    borderWidth: 3,
                    tension: 0.4
                }]
            },
            options: { responsive: true }
        });
    }
    
    const causesCtx = document.getElementById('causesChart');
    if (causesCtx) {
        new Chart(causesCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Sawit', 'Penebangan', 'Lahan', 'Kebakaran', 'Infra'],
                datasets: [{
                    data: [40, 25, 20, 10, 5],
                    backgroundColor: ['#d32f2f', '#f57c00', '#388e3c', '#ffc107', '#2196f3']
                }]
            }
        });
    }
    
    const islandCtx = document.getElementById('islandChart');
    if (islandCtx) {
        new Chart(islandCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Sumatra', 'Kalimantan', 'Papua', 'Sulawesi', 'Jawa'],
                datasets: [{
                    label: 'Hektar',
                    data: [45000, 65000, 80000, 25000, 15000],
                    backgroundColor: '#388e3c'
                }]
            }
        });
    }
}

function initializeScrollToTop() {
    const scrollBtn = document.getElementById('scroll-top');
    window.addEventListener('scroll', () => {
        if (scrollBtn) {
            scrollBtn.classList.toggle('visible', window.pageYOffset > 300);
        }
    });
}

function displayQuestion() {
    const quizContainer = document.getElementById('quiz-container');
    if (!quizContainer) return;

    const q = quizQuestions[currentQuestionIndex];
    quizContainer.innerHTML = `
        <p><strong>${q.question}</strong></p>
        <div id="options-group">
            ${q.options.map((option, index) => `
                <button class="quiz-option" data-answer="${option}" onclick="selectAnswer(this)">${String.fromCharCode(65 + index)}. ${option}</button>
            `).join('')}
        </div>
    `;
    
    document.getElementById('progress-text').textContent = `Pertanyaan ${currentQuestionIndex + 1} dari ${quizQuestions.length}`;
    updateProgress();
    
    const nextBtn = document.getElementById('next-btn');
    const finishBtn = document.getElementById('finish-btn');
    if (nextBtn) nextBtn.style.display = 'none';
    if (finishBtn) finishBtn.style.display = 'none';
}

function updateProgress() {
    const progressFill = document.getElementById('progress-fill');
    if (progressFill) {
        progressFill.style.width = ((currentQuestionIndex + 1) / quizQuestions.length * 100) + '%';
    }
}

function selectAnswer(button) {
    const selectedAnswer = button.getAttribute('data-answer');
    const correctAnswer = quizQuestions[currentQuestionIndex].answer;
    const resultDisplay = document.getElementById('quiz-result');
    const options = document.querySelectorAll('.quiz-option');
    
    options.forEach(btn => {
        btn.disabled = true;
        if (btn.getAttribute('data-answer') === correctAnswer) {
            btn.style.backgroundColor = '#4CAF50';
        } else if (btn === button) {
            btn.style.backgroundColor = '#F44336';
        }
    });

    if (selectedAnswer === correctAnswer) {
        score++;
        if (resultDisplay) {
            resultDisplay.innerHTML = '✅ <strong>Benar!</strong> ' + quizQuestions[currentQuestionIndex].explanation;
            resultDisplay.style.color = '#2e7d32';
        }
    } else {
        if (resultDisplay) {
            resultDisplay.innerHTML = '❌ <strong>Salah.</strong> Jawaban benar: ' + correctAnswer;
        resultDisplay.style.color = '#c62828';
        }
    }

    if (currentQuestionIndex < quizQuestions.length - 1) {
        document.getElementById('next-btn').style.display = 'block';
    } else {
        document.getElementById('finish-btn').style.display = 'block';
    }
}

function nextQuestion() {
    currentQuestionIndex++;
    displayQuestion();
}

function showResults() {
    const quizContainer = document.getElementById('quiz-container');
    const percentage = Math.round((score / quizQuestions.length) * 100);
    const emoji = percentage >= 80 ? '🏆' : percentage >= 60 ? '👍' : '📚';
    
    quizContainer.innerHTML = `
        <h3>Hasil Kuis</h3>
        <div style="font-size: 3rem">${emoji}</div>
        <p style="font-size: 1.5rem">Skor: ${score}/${quizQuestions.length} (${percentage}%)</p>
        <button class="btn btn-primary" onclick="location.reload()">Ulangi</button>
    `;
    document.getElementById('finish-btn').style.display = 'none';
}

function showSpeciesModal(speciesId) {
    const modal = document.getElementById('species-modal');
    const modalBody = document.getElementById('species-modal-body');
    const data = speciesData[speciesId];
    
    if (modalBody && data) {
        modalBody.innerHTML = `
            <h2>${data.emoji} ${data.name}</h2>
            <p><strong>Status:</strong> ${data.status}</p>
            <p><strong>Populasi:</strong> ${data.population}</p>
            <p><strong>Lokasi:</strong> ${data.location}</p>
            <h3>Ancaman:</h3><ul>${data.threats.map(t => `<li>${t}</li>`).join('')}</ul>
            <h3>Fakta:</h3><ul>${data.facts.map(f => `<li>${f}</li>`).join('')}</ul>
        `;
    }
    if (modal) modal.style.display = 'block';
}

function closeSpeciesModal() {
    document.getElementById('species-modal').style.display = 'none';
}

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ===== MINI GAMES =====

// Memory Match Game
let memoryCards = [];
let flippedCards = [];
let matchedPairs = 0;
let memoryMoves = 0;
let memoryTime = 0;
let memoryTimer;
let isMemoryGameStarted = false;

const memoryPairs = [
    { emoji: '🦧', name: 'Orangutan' },
    { emoji: '🐅', name: 'Harimau Sumatra' },
    { emoji: '🦏', name: 'Badak Jawa' },
    { emoji: '🐘', name: 'Gajah Sumatra' },
    { emoji: '🦜', name: 'Cendrawasih' },
    { emoji: '🐻', name: 'Beruang Madu' }
];

function startMemoryGame() {
    if (isMemoryGameStarted) return;
    isMemoryGameStarted = true;
    memoryCards = [...memoryPairs, ...memoryPairs].sort(() => Math.random() - 0.5);
    flippedCards = [];
    matchedPairs = 0;
    memoryMoves = 0;
    memoryTime = 0;
    
    const board = document.getElementById('memory-board');
    board.innerHTML = memoryCards.map((card, index) => 
        `<div class="memory-card" onclick="flipCard(${index})">?</div>`
    ).join('');
    
    updateMemoryStats();
    memoryTimer = setInterval(() => {
        memoryTime++;
        document.getElementById('memory-time').textContent = memoryTime;
    }, 1000);
}

function flipCard(index) {
    const card = document.querySelectorAll('.memory-card')[index];
    if (card.classList.contains('flipped') || card.classList.contains('matched')) return;
    
    card.textContent = memoryCards[index].emoji;
    card.classList.add('flipped');
    flippedCards.push(index);
    
    if (flippedCards.length === 2) {
        memoryMoves++;
        setTimeout(checkMatch, 1000);
    }
}

function checkMatch() {
    const [first, second] = flippedCards;
    const firstCard = memoryCards[first];
    const secondCard = memoryCards[second];
    
    if (firstCard.name === secondCard.name) {
        document.querySelectorAll('.memory-card')[first].classList.add('matched');
        document.querySelectorAll('.memory-card')[second].classList.add('matched');
        matchedPairs++;
        updateMemoryStats();
        
        if (matchedPairs === memoryPairs.length) {
            endMemoryGame();
        }
    } else {
        document.querySelectorAll('.memory-card')[first].textContent = '?';
        document.querySelectorAll('.memory-card')[second].textContent = '?';
        document.querySelectorAll('.memory-card')[first].classList.remove('flipped');
        document.querySelectorAll('.memory-card')[second].classList.remove('flipped');
        updateMemoryStats();
    }
    
    flippedCards = [];
}

function updateMemoryStats() {
    document.getElementById('memory-moves').textContent = memoryMoves;
    document.getElementById('memory-score').textContent = calculateMemoryScore();
}

function calculateMemoryScore() {
    const baseScore = 1000;
    const timePenalty = memoryTime * 10;
    const movesPenalty = memoryMoves * 5;
    return Math.max(0, baseScore - timePenalty - movesPenalty);
}

function endMemoryGame() {
    clearInterval(memoryTimer);
    const result = document.getElementById('memory-result');
    result.innerHTML = `🏆 Permainan Selesai! Skor: ${calculateMemoryScore()}`;
    result.classList.add('show');
    isMemoryGameStarted = false;
}

function resetMemoryGame() {
    clearInterval(memoryTimer);
    document.getElementById('memory-board').innerHTML = '';
    document.getElementById('memory-result').classList.remove('show');
    document.getElementById('memory-time').textContent = '0';
    document.getElementById('memory-moves').textContent = '0';
    document.getElementById('memory-score').textContent = '0';
    isMemoryGameStarted = false;
}

// Tree Planting Game
let treeCells = Array(25).fill(false);
let treeScore = 0;
let co2Absorbed = 0;
let treeCount = 0;
let fireInterval;

function startTreeGame() {
    const grid = document.getElementById('tree-grid');
    grid.innerHTML = Array(25).fill().map((_, i) => 
        `<div class="tree-cell" onclick="plantTree(${i})"></div>`
    ).join('');
    
    treeCells = Array(25).fill(false);
    treeScore = 0;
    co2Absorbed = 0;
    treeCount = 0;
    updateTreeStats();
    
    fireInterval = setInterval(() => {
        const emptyCells = treeCells.map((filled, i) => filled ? -1 : i).filter(i => i !== -1);
        if (emptyCells.length > 0) {
            const randomCell = emptyCells[Math.floor(Math.random() * emptyCells.length)];
            startFire(randomCell);
        }
    }, 3000);
}

function plantTree(index) {
    if (treeCells[index]) return;
    treeCells[index] = true;
    treeCount++;
    co2Absorbed += 0.5;
    treeScore += 100;
    
    const cell = document.querySelectorAll('.tree-cell')[index];
    cell.textContent = '🌳';
    cell.classList.add('planted');
    
    updateTreeStats();
}

function startFire(index) {
    const cell = document.querySelectorAll('.tree-cell')[index];
    cell.textContent = '🔥';
    cell.classList.add('on-fire');
    
    const warning = document.getElementById('fire-warning');
    warning.textContent = '⚠️ Peringatan! Kebakaran terdeteksi!';
    warning.classList.add('show');
    
    setTimeout(() => {
        if (!treeCells[index]) {
            cell.classList.remove('on-fire');
            cell.textContent = '';
            warning.classList.remove('show');
        }
    }, 2000);
}

function updateTreeStats() {
    document.getElementById('tree-count').textContent = treeCount;
    document.getElementById('co2-absorbed').textContent = co2Absorbed.toFixed(1);
    document.getElementById('tree-score').textContent = treeScore;
}

function resetTreeGame() {
    clearInterval(fireInterval);
    document.getElementById('tree-grid').innerHTML = '';
    document.getElementById('fire-warning').classList.remove('show');
    document.getElementById('tree-count').textContent = '0';
    document.getElementById('co2-absorbed').textContent = '0';
    document.getElementById('tree-score').textContent = '0';
}

// Save Forest Game
let forestHealth = 100;
let threatsActive = [];
let saveScore = 0;
let threatSpawnInterval;

const threatTypes = [
    { emoji: '🔥', name: 'Kebakaran', damage: 5, class: 'threat-fire' },
    { emoji: '🪓', name: 'Penebangan', damage: 10, class: 'threat-saw' },
    { emoji: '☁️', name: 'Polusi', damage: 3, class: 'threat-pollution' },
    { emoji: '🎯', name: 'Perburuan', damage: 7, class: 'threat-hunter' }
];

function startSaveGame() {
    forestHealth = 100;
    saveScore = 0;
    threatsActive = [];
    updateForestHealth();
    updateSaveStats();
    
    const container = document.getElementById('threats-container');
    container.innerHTML = '';
    
    threatSpawnInterval = setInterval(() => {
        spawnThreat();
    }, 2000);
    
    const healthInterval = setInterval(() => {
        if (forestHealth <= 0) {
            clearInterval(healthInterval);
            clearInterval(threatSpawnInterval);
            endSaveGame();
        }
    }, 100);
}

function spawnThreat() {
    if (threatsActive.length >= 8) return;
    
    const threat = threatTypes[Math.floor(Math.random() * threatTypes.length)];
    const threatElement = document.createElement('div');
    threatElement.className = `threat-item ${threat.class}`;
    threatElement.textContent = threat.emoji;
    threatElement.style.left = Math.random() * 80 + '%';
    threatElement.style.top = Math.random() * 60 + '%';
    threatElement.onclick = () => eliminateThreat(threatElement, threat);
    
    document.getElementById('threats-container').appendChild(threatElement);
    threatsActive.push({ element: threatElement, damage: threat.damage });
    
    const damageInterval = setInterval(() => {
        forestHealth -= threat.damage * 0.1;
        updateForestHealth();
        if (!threatElement.parentElement) clearInterval(damageInterval);
    }, 200);
}

function eliminateThreat(element, threat) {
    element.classList.add('eliminated');
    forestHealth = Math.min(100, forestHealth + 5);
    saveScore += 50;
    updateForestHealth();
    updateSaveStats();
    
    setTimeout(() => element.remove(), 500);
    threatsActive = threatsActive.filter(t => t.element !== element);
}

function updateForestHealth() {
    document.getElementById('forest-health').textContent = Math.max(0, Math.ceil(forestHealth));
    document.getElementById('forest-bar').style.width = Math.max(0, forestHealth) + '%';
}

function updateSaveStats() {
    document.getElementById('threats-left').textContent = threatsActive.length;
    document.getElementById('save-score').textContent = saveScore;
}

function endSaveGame() {
    const result = document.getElementById('threats-container');
    result.innerHTML = `<div style="text-align: center; font-size: 2rem; padding: 2rem;">
        <h2>🌲 Game Over!</h2>
        <p>Skor Akhir: ${saveScore}</p>
        <button class="btn btn-primary" onclick="startSaveGame()">Main Lagi</button>
    </div>`;
}

// Global
window.selectAnswer = selectAnswer;
window.showSpeciesModal = showSpeciesModal;
window.closeSpeciesModal = closeSpeciesModal;
window.scrollToTop = scrollToTop;
window.flipCard = flipCard;
window.startMemoryGame = startMemoryGame;
window.resetMemoryGame = resetMemoryGame;
window.startTreeGame = startTreeGame;
window.resetTreeGame = resetTreeGame;
window.plantTree = plantTree;
window.startSaveGame = startSaveGame;
window.eliminateThreat = eliminateThreat;

