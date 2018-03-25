<style>
    .ui.header {
        padding-top: 1em;
    }
</style>

<div class="ui inverted vertical masthead center aligned segment hero">
    <div class="ui text container">
        <h1 class="ui inverted header">
            APU DDAC Maersk Line
        </h1>
        <h2>Cargo Specialist</h2>
        <a href="/register" class="ui huge inverted button">Ship Now</a>
    </div>
</div>

<div class="ui vertical stripe quote segment" style="background: white;margin-bottom: 60px;">
    <div class="ui equal width stackable internally celled grid">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="two wide right floated column column">
                </div>
                <img src="/img/track.png" class="ui rounded image">
                <div class="nine wide left floated column">
                    <h1>Track Booking</h1>
                    <div class="internal">
                        <form class="form--track-shipment" action="/track" method="GET" target="_blank" novalidate="novalidate" data-validation-message--required="This field is required" data-validation-message-error="Required">
                            <div class="field">
                                <div class="ui input">
                                    <input id="shipmentId" name="searchNumber" placeholder="Booking no." maxlength="10" class="form-control" type="text" required>
                                </div>
                                <button type="submit" class="ui secondary basic button">
                                    Track Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>