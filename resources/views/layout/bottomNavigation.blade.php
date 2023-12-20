<div class="appBottomMenu">
        <a href="/dashboard" class="item {{ request()->is('dashboard') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="home-outline"></ion-icon>
                <strong>Home</strong>
            </div>
        </a>
        <a href="/vote/create" class="item {{ request()->is('vote/create') ? 'active' : '' }}">
            <div class="col">
                <div class="action-button large">
                    <ion-icon name="cube-outline"></ion-icon>
                </div>
            </div>
        </a>
        <a href="/sispilu/voters/add" class="item {{ request()->is('sispilu/voters/add') ? 'active' : '' }}">
            <div class="col">
                <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
                <strong>Add Voters</strong>
            </div>
        </a>
    </div>
