# Seeding

Sometimes, you may have the same URL in multiple places. The default behavior is to return the same set of images for each instance, but this might not be what you need. That’s why we implemented the seeding feature, which allows you to achieve more randomness based on your specific requirements.

## First Instance

<c-img src="images"/>

```txt-vue
{{ baseURL }}/images

```

## Another Instance

<c-img src="images"/>

```txt-vue
{{ baseURL }}/images

```

## Seeded Instance

<c-img src="images?seed=1"/>

```txt-vue
{{ baseURL }}/images?seed=1

```

## Another Seeded Instance

<c-img src="images?just-kidding=lol"/>

```txt-vue
{{ baseURL }}/images?just-kidding=lol

```

## Final Notes

Seeds dont have to be anything specific, just adding to arbitary query parameters will seed the randomization engine and ensure you get random values each time.

<script setup>
    import { baseURL, categories } from "./.vitepress/theme/index"
</script>
