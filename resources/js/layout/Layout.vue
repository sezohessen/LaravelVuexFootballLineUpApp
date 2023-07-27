<template>
    <div class="layout">
        <div class="sidebar">
            <ul>
                <li>
                    <div class="menu-item">
                        <router-link to="/player">Player</router-link>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <router-link to="/lines">Lines</router-link>
                    </div>
                </li>
                <li>
                    <div class="menu-item">
                        <router-link to="/formations">Formations</router-link>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="card">
                <router-view name="content"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // Your layout logic here
};
</script>

<style>
/* Your layout CSS here */
.layout {
    display: flex;
    min-height: 100vh;
}

.sidebar {
    flex: 0 0 200px;
    background-color: #34495e;
    /* Sidebar background color */
    color: #fff;
    /* Sidebar text color */
    padding: 20px;
    box-sizing: border-box;
    transition: width 0.3s ease;
    /* Sidebar animation */
}

.sidebar:hover {
    width: 220px;
    /* Sidebar width on hover */
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar li {
    margin-bottom: 10px;
}

.menu-item {
    height: 50px;
    /* Set the height of each list item */
    display: flex;
    align-items: center;
}

.sidebar a {
    text-decoration: none;
    color: #fff;
    /* Sidebar link color */
    width: 100%;
    height: 100%;
    display: block;
    padding: 10px;
    box-sizing: border-box;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.sidebar a:hover {
    background-color: #2c3e50;
    /* Sidebar link background color on hover */
}

.container {
    flex: 1;
    padding: 20px;
    box-sizing: border-box;
}

.card {
    background-color: #fff;
    /* Card background color */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    height: 100%;
    /* Make the card take full height */
}</style>
