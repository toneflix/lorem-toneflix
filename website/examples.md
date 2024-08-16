# Usage Examples

Learn how to make the most out of Lorem Toneflix by following the examples we provide here.

## Anything Random

By Default, Lorem Toneflix will return a random image when ever called.

<c-img src="images"/>

```txt-vue
{{ baseURL }}/images

```

## Image Resolution

You can also dictate what resolutions that generated images should be in by passing the `w` and `h` query parameters representing `width` and `height` respectively

<c-img src="images?w=100&h=100"/>

```txt-vue
{{ baseURL }}/images?w=100&h=100

```

## Category

Lorem Toneflix currently supports the following categories `{{categories.map((e,i)=>(i===categories.length-1?'and '+e:e)).join(', ')}}`, to request a specific category, call the `images/{category}` endpoint, where `{category}` is one of the currently supported categories.

<c-img src="images/avatar"/>

```txt-vue
{{ baseURL }}/images/avatar

```

## Text

To add text on top of an image, simply pass the text to to the `text` query parameter or pass `true` to add the file name on the image, usefull if you intend to use the image name to return a particular image at all times.

<c-img src="images?text=I+Love+You"/>

```txt-vue
{{ baseURL }}/images?text=I+Love+You

```

OR

```txt-vue
{{ baseURL }}/images?text=true

```

## Filters

Lorem Toneflix provides a few filters to help you customize your images.

_Some filters accept an optional `parameter` in which case they can be passsed by appending it to the filter name separated by a `:`, E.g: `filters=blur:10`_

### Blur | `:amount`

Allows you to add gausian blur to your image, accepts an optional `amount` parameter.

<c-img src="images/avatar?filters=blur:15"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=blur:15

```

### Invert

Allows you invert all colors of the image.

<c-img src="images/avatar?filters=invert"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=invert

```

### Sharpen | `:amount`

Allows you sharpen the image.

<c-img src="images/avatar?filters=sharpen:15"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=sharpen:15

```

### Pixelate | `:amount`

Allows you pixelate the image.

<c-img src="images/avatar?filters=pixelate:7"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=pixelate:7

```

### Greyscale

Turn image into a greyscale version.

<c-img src="images/avatar?filters=greyscale"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=greyscale

```

### Combining Filters

Filters can also be combined to create more effects.

<c-img src="images/avatar?filters=greyscale,pixelate:10,blur:5"/>

```txt-vue
{{ baseURL }}/images/avatar?filters=greyscale,pixelate:10,blur:5

```

<script setup>
    import { baseURL, categories } from "./.vitepress/theme/index"
</script>
