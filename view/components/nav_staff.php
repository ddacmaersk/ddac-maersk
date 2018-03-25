<div class="ui container">
    <a href="/shipping" class="item" style="color: white">Shipping</a>
    <a href="/viewSchedule" class="item" style="color: white">Schedule</a>
    <a href="/viewMember" class="item" style="color: white">Member</a>
    <div class="right menu">
        <div class="item">
            <h4 style="color: white"><?php echo $_SESSION['fullname']?></h4>
        </div>
        <div class="item">
            <a href="/logout" class="ui inverted button">Log Out</a>
        </div>
    </div>
</div>