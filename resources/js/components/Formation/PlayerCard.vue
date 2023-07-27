<template>
    <div class="line-container" :class="stylish">
        <div v-for="player in players" :key="player.id">
            <div class="player-card">
                <span class="player-name">{{ player.name }}</span>
                <span class="player-tshirt">{{ player.t_shirt_num }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['players','stylish'],
};
</script>
