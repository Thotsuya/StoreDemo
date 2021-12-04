<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <div
                    v-if="link.url === null"
                    :key="key"
                    class="
                        px-4
                        py-3
                        mb-1
                        mr-1
                        text-sm
                        leading-4
                        text-gray-400
                        border
                        rounded
                    "
                    v-html="link.label"
                />
                <Link
                    v-else
                    class="
                        px-4
                        py-3
                        mb-1
                        mr-1
                        text-sm
                        leading-4
                        border
                        rounded
                        hover:bg-indigo-400
                        hover:text-white
                        transition
                        ease-in-out
                        duration-200
                        focus:border-indigo-500 focus:text-white
                    "
                    :class="{ 'bg-indigo-500 text-white': link.active }"
                    :href="link.url"
                    v-html="link.label"
                />
            </template>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        Link,
    },

    props: {
        links: Array,
    },
};
</script>
