// Enhanced Hamburger menu functionality
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('nav-menu');

hamburger.addEventListener('click', (e) => {
    e.stopPropagation();
    hamburger.classList.toggle('active');
    navMenu.classList.toggle('active');

    // Add body scroll lock when menu is open
    if (navMenu.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
});

// Enhanced mobile dropdown functionality
function initMobileDropdowns() {
    if (window.innerWidth <= 768) {
        // Handle main dropdowns
        document.querySelectorAll('.nav-item.dropdown').forEach(dropdown => {
            const dropdownContent = dropdown.querySelector('.dropdown-content');
            const navLink = dropdown.querySelector('.nav-link');

            // Skip nested dropdowns for now
            if (dropdown.closest('.dropdown-content')) return;

            navLink.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                // Close other main dropdowns
                document.querySelectorAll('.nav-item.dropdown > .dropdown-content').forEach(content => {
                    if (content !== dropdownContent) {
                        content.classList.remove('show');
                        // Also close nested dropdowns
                        content.querySelectorAll('.dropdown-content.right').forEach(nested => {
                            nested.classList.remove('show');
                        });
                    }
                });

                // Toggle current dropdown
                dropdownContent.classList.toggle('show');
            });
        });

        // Handle nested dropdowns (OIG submenu)
        document.querySelectorAll('.dropdown-content .nav-item.dropdown').forEach(nestedDropdown => {
            const nestedContent = nestedDropdown.querySelector('.dropdown-content.right');
            const nestedLink = nestedDropdown.querySelector('.nav-link');

            if (nestedContent && nestedLink) {
                nestedLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close other nested dropdowns in the same parent
                    const parentDropdown = nestedDropdown.closest('.dropdown-content');
                    parentDropdown.querySelectorAll('.dropdown-content.right').forEach(content => {
                        if (content !== nestedContent) {
                            content.classList.remove('show');
                        }
                    });

                    // Toggle current nested dropdown
                    nestedContent.classList.toggle('show');
                });
            }
        });
    }
}

// Initialize mobile dropdowns
initMobileDropdowns();

// Function to adjust dropdown position based on viewport
function adjustDropdownPosition() {
    const nestedDropdowns = document.querySelectorAll('.nav-item.dropdown .dropdown-content .nav-item.dropdown');

    nestedDropdowns.forEach(dropdown => {
        const dropdownContent = dropdown.querySelector('.dropdown-content.right');
        if (!dropdownContent) return;

        // Remove existing event listeners to prevent duplicates
        dropdown.removeEventListener('mouseenter', handleDropdownPosition);
        dropdown.removeEventListener('mouseleave', handleDropdownReset);
        dropdown.addEventListener('mouseenter', handleDropdownPosition);
        dropdown.addEventListener('mouseleave', handleDropdownReset);

        function handleDropdownReset() {
            // Reset any inline styles when mouse leaves
            dropdownContent.style.maxWidth = '';
            dropdownContent.classList.remove('left-positioned');
        }

        function handleDropdownPosition() {
            // Reset classes first
            dropdownContent.classList.remove('left-positioned');

            // Use requestAnimationFrame for better performance
            requestAnimationFrame(() => {
                // Force a reflow to get accurate measurements
                dropdownContent.style.display = 'block';
                dropdownContent.style.opacity = '0';
                dropdownContent.style.visibility = 'visible';

                requestAnimationFrame(() => {
                    const rect = dropdownContent.getBoundingClientRect();
                    const viewportWidth = window.innerWidth;
                    const buffer = 20; // Safety buffer

                    // Check if dropdown would overflow on the right
                    if (rect.right > viewportWidth - buffer) {
                        dropdownContent.classList.add('left-positioned');

                        // Double-check if left positioning also causes overflow
                        requestAnimationFrame(() => {
                            const newRect = dropdownContent.getBoundingClientRect();
                            if (newRect.left < buffer) {
                                // If both sides overflow, keep it on the right but adjust width
                                dropdownContent.classList.remove('left-positioned');
                                dropdownContent.style.maxWidth = `${viewportWidth - rect.left - buffer}px`;
                            }
                        });
                    }

                    // Reset styles to let CSS handle the animation
                    dropdownContent.style.display = '';
                    dropdownContent.style.opacity = '';
                    dropdownContent.style.visibility = '';
                });
            });
        }
    });
}

// Initialize dropdown position adjustment
adjustDropdownPosition();

// Re-adjust on window resize
window.addEventListener('resize', adjustDropdownPosition);

// Close menu when clicking on a link (except dropdown toggles)
document.querySelectorAll('.nav-link').forEach(link => {
    if (!link.closest('.dropdown')) {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
        document.body.style.overflow = '';

        // Close all mobile dropdowns including nested ones
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });
        document.querySelectorAll('.dropdown-content.right').forEach(content => {
            content.classList.remove('show');
        });
    }
});

// Handle window resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
        document.body.style.overflow = '';

        // Remove mobile dropdown classes
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });
    } else {
        // Reinitialize mobile dropdowns when resizing to mobile
        initMobileDropdowns();
    }
});

// Slider functionality
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.slide');
const indicators = document.querySelectorAll('.indicator');
const totalSlides = slides.length;

function showSlide(index) {
    // Check if slides and indicators exist
    if (slides.length === 0 || indicators.length === 0) {
        return;
    }
    
    // Hide all slides
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));

    // Show current slide
    if (slides[index] && indicators[index]) {
        slides[index].classList.add('active');
        indicators[index].classList.add('active');
    }
}

function changeSlide(direction) {
    // Check if slides exist
    if (slides.length === 0) {
        return;
    }
    
    currentSlideIndex += direction;

    if (currentSlideIndex >= totalSlides) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = totalSlides - 1;
    }

    showSlide(currentSlideIndex);
}

function currentSlide(index) {
    // Check if slides exist
    if (slides.length === 0) {
        return;
    }
    
    currentSlideIndex = index - 1;
    showSlide(currentSlideIndex);
}

// Tambahkan fungsi yang hilang
function nextSlide() {
    changeSlide(1);
}

function prevSlide() {
    changeSlide(-1);
}

function startSlideInterval() {
    if (slides.length > 0) {
        autoSlideInterval = setInterval(() => {
            changeSlide(1);
        }, 5000);
    }
}

// Auto slide with pause on hover
let autoSlideInterval;
startSlideInterval();

// Pause auto slide on hover
const sliderContainer = document.querySelector('.slider-container');
if (sliderContainer && slides.length > 0) {
    sliderContainer.addEventListener('mouseenter', () => {
        if (autoSlideInterval) {
            clearInterval(autoSlideInterval);
        }
    });

    sliderContainer.addEventListener('mouseleave', () => {
        startSlideInterval();
    });
}

// Enhanced scroll effects with improved navbar
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelector('.hero-overlay');
    const navbar = document.querySelector('.navbar');

    // Parallax effect for hero overlay
    if (parallax) {
        parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
    }

    // Enhanced navbar background change on scroll
    if (navbar) {
        if (scrolled > 100) {
            navbar.style.background = 'linear-gradient(135deg, rgba(153, 121, 57, 0.95) 0%, rgba(181, 151, 86, 0.95) 50%, rgba(153, 121, 57, 0.95) 100%)';
            navbar.style.backdropFilter = 'blur(15px)';
            navbar.style.boxShadow = '0 8px 32px rgba(153, 121, 57, 0.4)';
            navbar.style.borderBottom = '3px solid rgba(181, 151, 86, 0.8)';
        } else {
            navbar.style.background = 'linear-gradient(135deg, #997939 0%, #b59756 50%, #997939 100%)';
            navbar.style.backdropFilter = 'blur(10px)';
            navbar.style.boxShadow = '0 4px 20px rgba(153, 121, 57, 0.3)';
            navbar.style.borderBottom = '3px solid #b59756';
        }
    }
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Card hover effects
document.querySelectorAll('.modern-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-10px) scale(1.02)';
    });

    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});

// Enhanced ripple effect for buttons and nav links
document.querySelectorAll('.btn-primary, .btn-secondary, .nav-link').forEach(element => {
    element.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        this.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Loading bar animation
function showLoadingBar() {
    const loadingBar = document.createElement('div');
    loadingBar.className = 'loading-bar';
    document.body.appendChild(loadingBar);

    let width = 0;
    const interval = setInterval(() => {
        width += Math.random() * 10;
        if (width >= 100) {
            width = 100;
            clearInterval(interval);
            setTimeout(() => {
                loadingBar.style.opacity = '0';
                setTimeout(() => {
                    if (loadingBar.parentNode) {
                        loadingBar.parentNode.removeChild(loadingBar);
                    }
                }, 300);
            }, 200);
        }
        loadingBar.style.width = width + '%';
    }, 100);
}

// Show loading bar on page navigation
document.querySelectorAll('a[href]:not([href^="#"])').forEach(link => {
    link.addEventListener('click', (e) => {
        if (link.hostname === window.location.hostname) {
            showLoadingBar();
        }
    });
});



// Loading animation for images
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('load', function() {
        this.style.opacity = '1';
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe elements for scroll animations
document.querySelectorAll('.modern-card, .schedule-item, .section-header').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});



// Intersection Observer for animations
const observerOptions2 = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer2 = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationDelay = '0s';
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions2);

// Observe elements for animation
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.schedule-item, .gallery-item, .contact-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer2.observe(el);
    });
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(autoSlideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(autoSlideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(autoSlideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(slideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(slideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(slideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
                <div class="lightbox-content">
                    <img src="${img.src}" alt="${img.alt}">
                    <button class="lightbox-close">&times;</button>
                </div>
            `;

            document.body.appendChild(lightbox);

            // Close lightbox functionality
            const closeBtn = lightbox.querySelector('.lightbox-close');
            closeBtn.addEventListener('click', () => {
                lightbox.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(lightbox);
                }, 300);
            });

            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(lightbox);
                    }, 300);
                }
            });
        });
    });
});

// Enhanced loading animation with navbar reveal
window.addEventListener('load', () => {
    // Initial page load animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.8s ease';

    // Navbar slide down animation
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        navbar.style.transform = 'translateY(-100%)';
        navbar.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
    }

    setTimeout(() => {
        document.body.style.opacity = '1';
        if (navbar) {
            navbar.style.transform = 'translateY(0)';
        }
    }, 200);

    // Add stagger animation to nav items
    setTimeout(() => {
        document.querySelectorAll('.nav-item').forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(-20px)';
            item.style.transition = 'all 0.4s ease';

            setTimeout(() => {
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }, 400);
});

// Parallax effect for hero section
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.hero');
    if (hero) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});



// Form validation
const forms = document.querySelectorAll('form');
forms.forEach(form => {
    form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan');
        }
    });
});

// File input preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.createElement('img');
            preview.classList.add('file-preview');

            reader.onload = (e) => {
                preview.src = e.target.result;
                const container = input.parentElement;
                const existingPreview = container.querySelector('.file-preview');
                if (existingPreview) {
                    container.removeChild(existingPreview);
                }
                container.appendChild(preview);
            };

            reader.readAsDataURL(file);
        }
    });
});

// Date input validation
const dateInputs = document.querySelectorAll('input[type="date"]');
dateInputs.forEach(input => {
    input.addEventListener('change', (e) => {
        const selectedDate = new Date(e.target.value);
        const today = new Date();

        if (selectedDate > today) {
            input.setCustomValidity('Tanggal tidak boleh lebih dari hari ini');
        } else {
            input.setCustomValidity('');
        }
    });
});

// Phone number validation
const phoneInputs = document.querySelectorAll('input[type="tel"]');
phoneInputs.forEach(input => {
    input.addEventListener('input', (e) => {
        const value = e.target.value.replace(/\D/g, '');
        if (value.length > 13) {
            e.target.value = value.slice(0, 13);
        } else {
            e.target.value = value;
        }
    });
});

// Success message auto-hide
const successMessage = document.querySelector('.success-message');
if (successMessage) {
    setTimeout(() => {
        successMessage.style.opacity = '0';
        setTimeout(() => {
            successMessage.remove();
        }, 300);
    }, 3000);
}

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});

// Enhanced responsive handling
function handleResponsiveChanges() {
    const isMobile = window.innerWidth <= 768;
    const isTablet = window.innerWidth > 768 && window.innerWidth <= 1024;
    
    // Adjust slider for mobile
    if (isMobile) {
        // Disable auto-slide on mobile for better UX
        clearInterval(slideInterval);
        
        // Adjust touch sensitivity
        enableTouchSlider();
    } else {
        // Re-enable auto-slide on desktop
        startSlideInterval();
    }
    
    // Adjust dropdown behavior
    adjustDropdownBehavior(isMobile);
    
    // Optimize animations for performance
    optimizeAnimations(isMobile);
}

// Touch slider for mobile
function enableTouchSlider() {
    let startX = 0;
    let endX = 0;
    
    const sliderContainer = document.querySelector('.slider-container');
    if (!sliderContainer) return;
    
    sliderContainer.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
    });
    
    sliderContainer.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const threshold = 50;
        const diff = startX - endX;
        
        if (Math.abs(diff) > threshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
}

// Optimize animations for mobile
function optimizeAnimations(isMobile) {
    const root = document.documentElement;
    
    if (isMobile) {
        // Reduce animation duration on mobile
        root.style.setProperty('--transition', 'all 0.2s ease');
    } else {
        // Full animations on desktop
        root.style.setProperty('--transition', 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)');
    }
}

// Enhanced resize handler
let resizeTimeout;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(() => {
        handleResponsiveChanges();
        adjustDropdownPosition();
    }, 250);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    handleResponsiveChanges();
});

// Gallery lightbox functionality
document.addEventListener('DOMContentLoaded', () => {
    const galleryItems = document.querySelectorAll('.gallery-item img');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            const lightbox = document.createElement('div');
            lightbox.className = 'lightbox';
            lightbox.innerHTML = `
