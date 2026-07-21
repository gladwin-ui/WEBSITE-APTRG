import Alpine from 'alpinejs';
import gsap from 'gsap';

// Menonaktifkan GSAP lag smoothing untuk mencegah efek fast-forward/catch-up saat tab kembali aktif
gsap.ticker.lagSmoothing(0);

window.Alpine = Alpine;

Alpine.start();

function initScrollReveal() {
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const reveals = document.querySelectorAll('.reveal');

    // --- Reveal on scroll ---
    if (reduce) {
        reveals.forEach((el) => el.classList.add('is-visible'));
    } else {
        const revObs = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add('is-visible');
                } else {
                    e.target.classList.remove('is-visible');
                }
            });
        }, {
            threshold: 0.05,
            rootMargin: '0px 0px 0px 0px'
        });
        reveals.forEach((el) => revObs.observe(el));
    }

    // --- Warna latar per section (hanya di beranda) ---
    const root = document.getElementById('home-root');
    if (root) {
        const sections = root.querySelectorAll('[data-bg]');
        const bgObs = new IntersectionObserver((entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    root.style.backgroundColor = e.target.dataset.bg;
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '-10% 0px -10% 0px'
        });
        sections.forEach((s) => bgObs.observe(s));
    }
}

document.addEventListener('DOMContentLoaded', initScrollReveal);

/* ============ TIMED CARDS (GSAP, klik-saja) — dipakai halaman Divisi ============ */
function initTimedCards() {
    const scene = document.querySelector('.tc-scene');
    if (!scene) return;                                            // hanya di halaman ber-.tc-scene
    if (!window.matchMedia('(min-width: 768px)').matches) return;  // desktop saja
    const data = window.TC_ITEMS || window.TEAMS || [];
    if (!data.length) return;

    const _ = (id) => document.getElementById(id);
    const set = gsap.set;
    const range = (n) => Array(n).fill(0).map((_, j) => j);

    _('demo').innerHTML =
        data.map((i, index) => `<div class="card" id="card${index}" data-index="${index}" style="background-image:url(${i.image})"></div>`).join('') +
        data.map((i, index) => `<div class="card-content" id="card-content-${index}"><div class="content-start"></div><div class="content-place">${i.place}</div><div class="content-title-1">${i.title}</div><div class="content-title-2">${i.title2}</div></div>`).join('');
    const slideNumbersEl = _('slide-numbers');
    if (slideNumbersEl) {
        slideNumbersEl.innerHTML =
            data.map((_, index) => `<div class="item" id="slide-item-${index}">${index + 1}</div>`).join('');
    }

    const getCard = (i) => `#card${i}`, getCardContent = (i) => `#card-content-${i}`, getSliderItem = (i) => `#slide-item-${i}`;
    let order = range(data.length);
    let detailsEven = true, offsetTop = 200, offsetLeft = 700, clicks = 0;
    const cardWidth = 200, cardHeight = 300, gap = 40, numberSize = 50, ease = 'sine.inOut';

    function fillDetails(di) {
        const a = detailsEven ? '#details-even' : '#details-odd';
        document.querySelector(`${a} .place-box .text`).textContent = data[di].place;
        document.querySelector(`${a} .title-1`).textContent = data[di].title;
        document.querySelector(`${a} .title-2`).textContent = data[di].title2;
        document.querySelector(`${a} .desc`).textContent = data[di].description;
        document.querySelector(`${a} .discover`).onclick = () => { window.location.href = data[di].href; };
    }

    function init() {
        const [active, ...rest] = order;
        const dA = detailsEven ? '#details-even' : '#details-odd';
        const dI = detailsEven ? '#details-odd' : '#details-even';
        const { innerHeight: height, innerWidth: width } = window;
        offsetTop = height - 430; offsetLeft = width - 830;

        set('#pagination', { top: offsetTop + 330, left: offsetLeft, y: 200, opacity: 0, zIndex: 60 });
        set(getCard(active), { x: 0, y: 0, width, height });
        set(getCardContent(active), { x: 0, y: 0, opacity: 0 });
        set(dA, { opacity: 0, zIndex: 22, x: -200 });
        set(dI, { opacity: 0, zIndex: 12 });
        ['.text', '.title-1', '.title-2'].forEach((s) => set(`${dI} ${s}`, { y: 100 }));
        set(`${dI} .desc`, { y: 50 }); set(`${dI} .cta`, { y: 60 });
        set('.progress-sub-foreground', { width: 500 * (1 / order.length) * (active + 1) });

        rest.forEach((i, index) => {
            set(getCard(i), { x: offsetLeft + 400 + index * (cardWidth + gap), y: offsetTop, width: cardWidth, height: cardHeight, zIndex: 30, borderRadius: 10 });
            set(getCardContent(i), { x: offsetLeft + 400 + index * (cardWidth + gap), zIndex: 40, y: offsetTop + cardHeight - 100 });
            set(getSliderItem(i), { x: (index + 1) * numberSize });
        });

        fillDetails(active);
        const d = 0.6;
        gsap.to('.cover', { x: width + 400, delay: 0.5, ease });
        rest.forEach((i, index) => {
            gsap.to(getCard(i), { x: offsetLeft + index * (cardWidth + gap), zIndex: 30, ease, delay: d });
            gsap.to(getCardContent(i), { x: offsetLeft + index * (cardWidth + gap), zIndex: 40, ease, delay: d });
        });
        gsap.to('#pagination', { y: 0, opacity: 1, ease, delay: d });
        gsap.to(dA, { opacity: 1, x: 0, ease, delay: d });
    }

    function step() {
        order.push(order.shift());
        detailsEven = !detailsEven;
        const dA = detailsEven ? '#details-even' : '#details-odd';
        const dI = detailsEven ? '#details-odd' : '#details-even';
        fillDetails(order[0]);

        set(dA, { zIndex: 22 });
        gsap.to(dA, { opacity: 1, delay: 0.4, ease });
        gsap.to(`${dA} .text`, { y: 0, delay: 0.1, duration: 0.7, ease });
        gsap.to(`${dA} .title-1`, { y: 0, delay: 0.15, duration: 0.7, ease });
        gsap.to(`${dA} .title-2`, { y: 0, delay: 0.15, duration: 0.7, ease });
        gsap.to(`${dA} .desc`, { y: 0, delay: 0.3, duration: 0.4, ease });
        gsap.to(`${dA} .cta`, { y: 0, delay: 0.35, duration: 0.4, ease });
        set(dI, { zIndex: 12 });

        const [active, ...rest] = order;
        const prv = rest[rest.length - 1];
        set(getCard(prv), { zIndex: 10 });
        set(getCard(active), { zIndex: 20 });
        gsap.to(getCard(prv), { scale: 1.5, ease });
        gsap.to(getCardContent(active), { y: offsetTop + cardHeight - 10, opacity: 0, duration: 0.3, ease });
        gsap.to(getSliderItem(active), { x: 0, ease });
        gsap.to(getSliderItem(prv), { x: -numberSize, ease });
        gsap.to('.progress-sub-foreground', { width: 500 * (1 / order.length) * (active + 1), ease });

        gsap.to(getCard(active), {
            x: 0, y: 0, ease, width: window.innerWidth, height: window.innerHeight, borderRadius: 0,
            onComplete: () => {
                const xNew = offsetLeft + (rest.length - 1) * (cardWidth + gap);
                set(getCard(prv), { x: xNew, y: offsetTop, width: cardWidth, height: cardHeight, zIndex: 30, borderRadius: 10, scale: 1 });
                set(getCardContent(prv), { x: xNew, y: offsetTop + cardHeight - 100, opacity: 1, zIndex: 40 });
                set(getSliderItem(prv), { x: rest.length * numberSize });
                set(dI, { opacity: 0 });
                ['.text', '.title-1', '.title-2'].forEach((s) => set(`${dI} ${s}`, { y: 100 }));
                set(`${dI} .desc`, { y: 50 }); set(`${dI} .cta`, { y: 60 });
                clicks -= 1;
                if (clicks > 0) step();
            },
        });

        rest.forEach((i, index) => {
            if (i !== prv) {
                const xNew = offsetLeft + index * (cardWidth + gap);
                set(getCard(i), { zIndex: 30 });
                gsap.to(getCard(i), { x: xNew, y: offsetTop, width: cardWidth, height: cardHeight, ease, delay: 0.1 * (index + 1) });
                gsap.to(getCardContent(i), { x: xNew, y: offsetTop + cardHeight - 100, opacity: 1, zIndex: 40, ease, delay: 0.1 * (index + 1) });
                gsap.to(getSliderItem(i), { x: (index + 1) * numberSize, ease });
            }
        });
    }

    function advance(steps) {                 // maju N langkah (klik-saja)
        if (steps <= 0) return;
        const wasIdle = clicks === 0;
        clicks += steps;
        if (wasIdle) step();
    }

    // Klik kartu antrian → maju ke tim itu; klik kartu aktif → buka detail
    _('demo').addEventListener('click', (e) => {
        const card = e.target.closest('.card');
        if (!card) return;
        const idx = +card.dataset.index;
        if (idx === order[0]) window.location.href = data[idx].href;
        else advance(order.indexOf(idx));      // posisi dalam antrian = jumlah langkah
    });

    // Panah manual
    document.querySelector('.arrow-right')?.addEventListener('click', () => advance(1));
    document.querySelector('.arrow-left')?.addEventListener('click', () => advance(order.length - 1));

    // Preload gambar lalu init
    Promise.all(data.map((d) => new Promise((res) => { const im = new Image(); im.onload = im.onerror = res; im.src = d.image; }))).then(init);
}

document.addEventListener('DOMContentLoaded', initTimedCards);
