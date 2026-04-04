/**
 * Reklam Okulu - Ana JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // --- Theme Toggle ---
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
            updateThemeIcon(next);
        });
    }

    function updateThemeIcon(theme) {
        if (!themeToggle) return;
        themeToggle.innerHTML = theme === 'dark'
            ? '<i class="fas fa-sun"></i>'
            : '<i class="fas fa-moon"></i>';
    }

    // --- Mobile Menu ---
    const mobileToggle = document.getElementById('mobileToggle');
    const mainNav = document.getElementById('mainNav');
    if (mobileToggle && mainNav) {
        mobileToggle.addEventListener('click', () => {
            mainNav.classList.toggle('active');
        });
    }

    // --- Countdown Timer ---
    const countdownTimers = document.querySelectorAll('.countdown-timer');
    countdownTimers.forEach(timer => {
        const targetDate = new Date(timer.dataset.date).getTime();
        if (!targetDate) return;

        function updateCountdown() {
            const now = Date.now();
            const diff = targetDate - now;

            if (diff <= 0) {
                timer.innerHTML = '<span>Kampanya sona erdi</span>';
                return;
            }

            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            timer.querySelector('.cd-days').textContent = days;
            timer.querySelector('.cd-hours').textContent = hours;
            timer.querySelector('.cd-minutes').textContent = minutes;
            timer.querySelector('.cd-seconds').textContent = seconds;
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    });

    // --- Animated Stats Counter ---
    const statNumbers = document.querySelectorAll('.stat-number[data-count]');
    if (statNumbers.length) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = parseInt(el.dataset.count);
                    animateCount(el, target);
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.5 });

        statNumbers.forEach(el => observer.observe(el));
    }

    function animateCount(el, target) {
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        function update() {
            current += step;
            if (current >= target) {
                el.textContent = target.toLocaleString('tr-TR');
                return;
            }
            el.textContent = Math.floor(current).toLocaleString('tr-TR');
            requestAnimationFrame(update);
        }
        update();
    }

    // --- Tabs ---
    const tabBtns = document.querySelectorAll('.tab-btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabId = btn.dataset.tab;
            const parent = btn.closest('.course-content-section') || document;

            parent.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            parent.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

            btn.classList.add('active');
            const target = document.getElementById('tab-' + tabId);
            if (target) target.classList.add('active');
        });
    });

    // --- FAQ Accordion ---
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(q => {
        q.addEventListener('click', () => {
            const answer = q.nextElementSibling;
            const isOpen = q.classList.contains('active');

            // Close all
            faqQuestions.forEach(other => {
                other.classList.remove('active');
                other.nextElementSibling.style.display = 'none';
            });

            // Toggle current
            if (!isOpen) {
                q.classList.add('active');
                answer.style.display = 'block';
            }
        });
    });

    // --- Curriculum Section Toggle ---
    const sectionToggles = document.querySelectorAll('.section-toggle');
    sectionToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const lessons = toggle.nextElementSibling;
            const isOpen = toggle.classList.contains('active');

            toggle.classList.toggle('active');
            lessons.style.display = isOpen ? 'none' : 'block';
        });
    });

    // --- Alert Auto-dismiss ---
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});