
import Alpine from 'alpinejs';
import AOS from 'aos';
import { createIcons, icons } from 'lucide';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'flowbite';

// Initialize Alpine
window.Alpine = Alpine;
Alpine.start();

// Initialize AOS
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        once: true,
        offset: 50,
    });
});

// Initialize Lucide Icons
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});

// Expose Swiper to window for usage in blade files if needed
window.Swiper = Swiper;
window.SwiperModules = { Navigation, Pagination, Autoplay };
