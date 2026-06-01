import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            search: '',
            products: window.initialProducts || [],
            // Bring Laravel variables into Vue state
            csrfToken: window.csrfToken || '',
            isAuthenticated: window.isAuthenticated || false,
            loginRoute: window.loginRoute || '',
            cartAddRouteTemplate: window.cartAddRouteTemplate || ''
        };
    },
    computed: {
        filtered() {
            if (!this.search) return [];
            return this.products.filter(p =>
                p.name.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    },
    methods: {
        formatPrice(price) {
            return 'RM' + parseFloat(price).toFixed(2);
        },
        handleSearch() {
            const grid = document.getElementById('blade-product-grid');
            if (grid) {
                grid.style.display = this.search ? 'none' : 'grid';
            }
        },
        // Replaces the dummy ID '999999' with the actual product ID for the form action
        getCartAction(id) {
            return this.cartAddRouteTemplate.replace('999999', id);
        }
    },
    template: `
        <div>
            <input 
                v-model="search" 
                @input="handleSearch"
                placeholder="Search products..." 
                style="width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 16px; margin-bottom:16px; font-size:15px;">
            
            <div v-if="search">
                <p style="color:#6b7280; font-size:14px; margin-bottom:12px;">
                    Showing results for: <strong>{{ search }}</strong> ({{ filtered.length }} found)
                </p>
                <div v-if="filtered.length === 0" style="color:#9ca3af; font-size:14px;">
                    No products found.
                </div>
                
                <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:24px;">
                    <div v-for="p in filtered" :key="p.id" style="background:white; border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; display:flex; flex-direction:column;">
                        <img v-if="p.image" :src="'/'+p.image" :alt="p.name" style="width:100%; height:200px; object-fit:contain; padding:16px; box-sizing:border-box;">
                        
                        <div style="padding:16px; display:flex; flex-direction:column; flex:1;">
                            <h3 style="font-weight:600; font-size:16px; margin-bottom:4px;">{{ p.name }}</h3>
                            <p style="color:#6b7280; font-size:14px; margin-bottom:8px;">{{ p.description }}</p>
                            <p style="font-weight:700; font-size:18px; margin-bottom:4px;">{{ formatPrice(p.price) }}</p>
                            <p style="color:#9ca3af; font-size:14px; margin-bottom:16px;">Stock: {{ p.stock }}</p>
                            
                            <div style="margin-top:auto;">
                                <form v-if="isAuthenticated" method="POST" :action="getCartAction(p.id)">
                                    <input type="hidden" name="_token" :value="csrfToken">
                                    <button type="submit" style="width:100%; background:#541A1A; color:white; border:none; border-radius:8px; padding:10px; font-size:15px; cursor:pointer;">
                                        Add to Cart
                                    </button>
                                </form>
                                <a v-else :href="loginRoute" style="display:block; text-align:center; background:#e5e7eb; border-radius:8px; padding:10px; text-decoration:none; color:#374151;">
                                    Login to buy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `
});

if (document.getElementById('vue-app')) {
    app.mount('#vue-app');
}