import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "Lorem Toneflix",
    assetsDir: 'doc-assets',
    description: "Open Source Image Placeholder Service",
    head: [
        ['link', { rel: 'icon', type: 'image/x-icon', href: 'https://lorem.toneflix.com.ng/logo-sm.png' }],
        ['script', { async: 'true', src: 'https://www.googletagmanager.com/gtag/js?id=G-FHM3VBSHSV' }],
        ['script', {}, `
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-FHM3VBSHSV');
        `],
    ],

    themeConfig: {
        footer: {
            message: 'Released under the MIT License.',
            copyright: `Copyright © ${new Date().getFullYear()}-present Toneflix`
        },
        logo: "https://lorem.toneflix.com.ng/logo-sm.png",
        // https://vitepress.dev/reference/default-theme-config
        nav: [
            { text: 'Home', link: '/' },
            { text: 'Examples', link: '/examples' }
        ],

        sidebar: [
            {
                text: 'Examples',
                items: [
                    { text: 'Usage Examples', link: '/examples' },
                    { text: 'Specific Image', link: '/specific' },
                    { text: 'Seeding', link: '/seeding' },
                ]
            }
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/toneflix/lorem-toneflix' }
        ]
    }
})
