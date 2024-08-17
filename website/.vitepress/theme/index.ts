// https://vitepress.dev/guide/custom-theme
import { h } from 'vue'
import type { Theme } from 'vitepress'
import DefaultTheme from 'vitepress/theme'
import CImage from '../components/CImg.vue'
import './style.css'

export const categories = ['avatar', 'album', 'event', 'poster', 'technology']
export const baseURL = import.meta.env.DEV
    ? import.meta.env.VITE_BASEURL_DEV
    : import.meta.env.VITE_BASEURL

export default {
    extends: DefaultTheme,
    Layout: () => {
        return h(DefaultTheme.Layout, null, {
            // https://vitepress.dev/guide/extending-default-theme#layout-slots
        })
    },
    enhanceApp ({ app, router, siteData }) {
        app.component('c-img', CImage)
    }
} satisfies Theme
