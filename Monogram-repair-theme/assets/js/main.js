/**
 * Monogram Repair Pro – Main JavaScript
 */
(function () {
    'use strict';

    // =========================================================
    // MOBILE NAV TOGGLE
    // =========================================================
    const navToggle = document.getElementById('nav-toggle');
    const mainNav   = document.getElementById('main-nav');

    if (navToggle && mainNav) {
        navToggle.addEventListener('click', function () {
            const isOpen = mainNav.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        });

        // Close nav on outside click
        document.addEventListener('click', function (e) {
            if (!mainNav.contains(e.target) && !navToggle.contains(e.target)) {
                mainNav.classList.remove('is-open');
                navToggle.setAttribute('aria-expanded', 'false');
                document.body.style.overflow = '';
            }
        });

        // Mobile sub-menu toggles
        const navItems = mainNav.querySelectorAll('li');
        navItems.forEach(function (li) {
            const subMenu = li.querySelector('.sub-menu');
            const link    = li.querySelector('a');
            if (subMenu && link && window.innerWidth <= 1024) {
                link.addEventListener('click', function (e) {
                    if (window.innerWidth <= 1024) {
                        e.preventDefault();
                        li.classList.toggle('is-open');
                    }
                });
            }
        });
    }

    // =========================================================
    // FAQ ACCORDION
    // =========================================================
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const isOpen = this.classList.contains('is-open');
            const answer = document.getElementById(this.getAttribute('aria-controls'));

            // Close all
            document.querySelectorAll('.faq-question.is-open').forEach(function (q) {
                q.classList.remove('is-open');
                q.setAttribute('aria-expanded', 'false');
                const ans = document.getElementById(q.getAttribute('aria-controls'));
                if (ans) ans.classList.remove('is-open');
            });

            // Open clicked (toggle)
            if (!isOpen) {
                this.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
                if (answer) answer.classList.add('is-open');
            }
        });
    });

    // =========================================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // =========================================================
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const id = this.getAttribute('href').slice(1);
            const target = document.getElementById(id);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.site-header')
                    ? document.querySelector('.site-header').offsetHeight
                    : 80;
                const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    // =========================================================
    // FLOATING PHONE BUTTON – hide on scroll up, show on down
    // =========================================================
    const floatingPhone = document.querySelector('.floating-phone');
    if (floatingPhone) {
        let lastScrollY = window.scrollY;
        let ticking = false;

        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    const currentScrollY = window.scrollY;
                    if (currentScrollY < 300) {
                        floatingPhone.style.opacity = '0';
                        floatingPhone.style.pointerEvents = 'none';
                    } else {
                        floatingPhone.style.opacity = '1';
                        floatingPhone.style.pointerEvents = '';
                    }
                    lastScrollY = currentScrollY;
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Initial state
        if (window.scrollY < 300) {
            floatingPhone.style.opacity = '0';
            floatingPhone.style.pointerEvents = 'none';
        }
        floatingPhone.style.transition = 'opacity 0.3s ease';
    }

    // =========================================================
    // STICKY HEADER SHADOW
    // =========================================================
    const siteHeader = document.querySelector('.site-header');
    if (siteHeader) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                siteHeader.style.boxShadow = '0 4px 24px rgba(0,0,0,0.3)';
            } else {
                siteHeader.style.boxShadow = '0 2px 20px rgba(0,0,0,0.2)';
            }
        }, { passive: true });
    }

    // =========================================================
    // HERO STATS – COUNT-UP ANIMATION ON VIEWPORT ENTRY
    // =========================================================
    var statsObserved = false;
    var statNumbers = document.querySelectorAll('.hero-stat-number[data-count]');

    if (statNumbers.length && 'IntersectionObserver' in window) {
        var statsObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !statsObserved) {
                    statsObserved = true;
                    statNumbers.forEach(function (el) {
                        var target = parseInt(el.getAttribute('data-count'), 10);
                        var suffix = el.getAttribute('data-suffix') || '';
                        var duration = 1800;
                        var start = 0;
                        var startTime = null;

                        function step(timestamp) {
                            if (!startTime) startTime = timestamp;
                            var progress = Math.min((timestamp - startTime) / duration, 1);
                            var eased = 1 - Math.pow(1 - progress, 3);
                            var current = Math.floor(eased * target);

                            if (suffix === 'k+') {
                                el.textContent = Math.floor(current / 1000) + 'k+';
                            } else {
                                el.textContent = current + suffix;
                            }

                            if (progress < 1) {
                                requestAnimationFrame(step);
                            } else {
                                el.textContent = suffix === 'k+' ? Math.floor(target / 1000) + 'k+' : target + suffix;
                            }
                        }
                        requestAnimationFrame(step);
                    });
                    statsObserver.disconnect();
                }
            });
        }, { threshold: 0.4 });

        var statsSection = document.querySelector('.hero-stats');
        if (statsSection) statsObserver.observe(statsSection);
    }

    // =========================================================
    // APPOINTMENT FORM – DATE & TIME PICKER
    // =========================================================
    var dateInput  = document.getElementById('brp_preferred_date');
    var timeRow    = document.getElementById('brpTimeRow');
    var timeSelect = document.getElementById('brp_preferred_time');
    var dateMsg    = document.getElementById('brpDateMsg');

    if (dateInput && brpData.availability) {
        var avail = brpData.availability;

        // Set min = today
        var today = new Date();
        var yyyy  = today.getFullYear();
        var mm    = String(today.getMonth() + 1).padStart(2, '0');
        var dd    = String(today.getDate()).padStart(2, '0');
        dateInput.min = yyyy + '-' + mm + '-' + dd;

        dateInput.addEventListener('change', function () {
            var val = this.value; // "YYYY-MM-DD"
            dateMsg.textContent = '';
            dateMsg.className   = 'brp-date-msg';
            timeRow.hidden      = true;
            timeSelect.innerHTML = '<option value="">— Select a time slot —</option>';

            if (!val) return;

            // Day-of-week check (0=Sun … 6=Sat)
            var parts   = val.split('-');
            var dateObj = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
            var dow     = dateObj.getDay();

            if (avail.blockedDates.indexOf(val) !== -1) {
                dateMsg.textContent = 'This date is not available (closed / holiday). Please choose another day.';
                dateMsg.className   = 'brp-date-msg brp-date-error';
                dateInput.value     = '';
                return;
            }

            if (avail.workingDays.indexOf(dow) === -1) {
                var dayNames = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
                dateMsg.textContent = dayNames[dow] + ' is not a working day. Please choose another date.';
                dateMsg.className   = 'brp-date-msg brp-date-error';
                dateInput.value     = '';
                return;
            }

            // Build time slots
            var startParts  = avail.hoursStart.split(':');
            var endParts    = avail.hoursEnd.split(':');
            var startMins   = parseInt(startParts[0]) * 60 + parseInt(startParts[1]);
            var endMins     = parseInt(endParts[0])   * 60 + parseInt(endParts[1]);
            var interval    = avail.slotInterval || 60;

            for (var mins = startMins; mins < endMins; mins += interval) {
                var h    = Math.floor(mins / 60);
                var m    = mins % 60;
                var ampm = h >= 12 ? 'PM' : 'AM';
                var h12  = h % 12 || 12;
                var label = h12 + ':' + String(m).padStart(2, '0') + ' ' + ampm;
                var opt   = document.createElement('option');
                opt.value = label;
                opt.textContent = label;
                timeSelect.appendChild(opt);
            }

            timeRow.hidden = false;
        });
    }

    // =========================================================
    // APPOINTMENT FORM – AJAX SUBMIT
    // =========================================================
    var apptForm = document.getElementById('brpAppointmentForm');
    if (apptForm) {
        apptForm.addEventListener('submit', function (e) {
            e.preventDefault();

            var submitBtn  = document.getElementById('brpSubmitBtn');
            var btnText    = submitBtn.querySelector('.brp-btn-text');
            var btnLoading = submitBtn.querySelector('.brp-btn-loading');
            var feedback   = document.getElementById('brpFormFeedback');

            // Basic validation
            var name  = apptForm.querySelector('#brp_name').value.trim();
            var phone = apptForm.querySelector('#brp_phone').value.trim();
            if (!name || !phone) {
                feedback.textContent = 'Please enter your name and phone number.';
                feedback.className   = 'brp-form-feedback brp-form-error';
                return;
            }

            // Disable button & show loading
            submitBtn.disabled  = true;
            btnText.hidden      = true;
            btnLoading.hidden   = false;
            feedback.textContent = '';
            feedback.className   = 'brp-form-feedback';

            // Build FormData
            var data = new FormData(apptForm);
            // Override nonce field name expected by PHP
            data.set('brp_nonce', apptForm.querySelector('[name="brp_form_nonce"]').value);

            fetch(brpData.ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                body: data,
            })
            .then(function (res) { return res.json(); })
            .then(function (json) {
                if (json.success) {
                    feedback.textContent = json.data.message;
                    feedback.className   = 'brp-form-feedback brp-form-success';
                    apptForm.reset();
                    // Reset time row after form clear
                    if (timeRow) { timeRow.hidden = true; }
                    if (dateMsg) { dateMsg.textContent = ''; }
                    submitBtn.disabled = false;
                    btnText.hidden     = false;
                    btnLoading.hidden  = true;
                } else {
                    feedback.textContent = (json.data && json.data.message) || 'Something went wrong. Please call us directly.';
                    feedback.className   = 'brp-form-feedback brp-form-error';
                    submitBtn.disabled = false;
                    btnText.hidden     = false;
                    btnLoading.hidden  = true;
                }
            })
            .catch(function () {
                feedback.textContent = 'Network error. Please call us at ' + brpData.phone + '.';
                feedback.className   = 'brp-form-feedback brp-form-error';
                submitBtn.disabled = false;
                btnText.hidden     = false;
                btnLoading.hidden  = true;
            });
        });
    }

    // =========================================================
    // ANIMATE ELEMENTS ON SCROLL
    // =========================================================
    if ('IntersectionObserver' in window) {
        const animItems = document.querySelectorAll('.card, .service-card, .city-card, .guide-card, .feature-item, .review-card');

        animItems.forEach(function (el) {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        });

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        animItems.forEach(function (el) {
            observer.observe(el);
        });
    }

    // =========================================================
    // PHONE NUMBER CLICK TRACKING (Google Analytics / GTM)
    // =========================================================
    document.querySelectorAll('a[href^="tel:"]').forEach(function (link) {
        link.addEventListener('click', function () {
            if (typeof gtag === 'function') {
                gtag('event', 'phone_click', {
                    event_category: 'Contact',
                    event_label: this.href,
                });
            }
            if (typeof dataLayer !== 'undefined') {
                dataLayer.push({
                    event: 'phoneClick',
                    phoneNumber: this.href.replace('tel:', ''),
                });
            }
        });
    });

    // =========================================================
    // BOOK APPOINTMENT BUTTON CLICK TRACKING
    // =========================================================
    document.querySelectorAll('a[href="#schedule"], .btn-primary').forEach(function (btn) {
        btn.addEventListener('click', function () {
            if (typeof gtag === 'function') {
                gtag('event', 'schedule_click', {
                    event_category: 'Lead',
                    event_label: 'Schedule Appointment CTA',
                });
            }
        });
    });

})();
