<div class="ui container">
    <a href="/member" class="item" style="color: white">Home</a>
    <a href="/account" class="item" style="color: white">Account</a>
    <a href="/booking" class="item" style="color: white">Book</a>
    <a href="/track" class="item" style="color: white">Track</a>
    <div class="right menu">
        <div class="item">
            <h4 style="color: white"><?php echo $_SESSION['fullname']?></h4>
        </div>
        <div class="item">
            <a href="/logout" class="ui inverted button">Log Out</a>
        </div>
    </div>
</div>