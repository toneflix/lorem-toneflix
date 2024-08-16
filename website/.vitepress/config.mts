import { defineConfig } from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "Lorem Toneflix",
    description: "Open Source Image Placeholder Service",
    head: [
        ['link', { rel: 'icon', type: 'image/x-icon', href: 'https://lorem.toneflix.com.ng/logo-sm.png' }]
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
                ]
            }
        ],

        socialLinks: [
            { icon: 'github', link: 'https://github.com/vuejs/vitepress' }
        ]
    }
})
