# Specific Image

Lorem toneflix also allows you to get a specific image at all time, taking away all the randomness.

To do this, first you need to get the `id` of the specific image you want to return by setting the `text=true` query parameter and passing it as a parameter to the `images/image/{imageId}` endpoint.

## Get Image ID

<c-img src="images/technology?text=true"/>

```txt-vue
{{ baseURL }}/images?text=true

```

## Get Specific Image

<c-img src="images/image/60033"/>

```txt-vue
{{ baseURL }}/images/image/60033

```

## With ID

Loading a specific image does not prevent you from passing the `text=true` parameter also.

<c-img src="images/image/60033?text=true"/>

```txt-vue
{{ baseURL }}/images/image/60033?text=true

```

<script setup>
    import { baseURL, categories } from "./.vitepress/theme/index"
</script>
