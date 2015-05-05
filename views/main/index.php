<?php
/**
 * @type User $user
 */
$user = $data['user'];
?>

<div class="error">
    <?php if (isset($data['error'])) { ?>
        <p><?php echo $data['error'];?> </p>
    <?php }?>
</div>

<div class="content">
    <h1>Hello: <?php echo $user->getName(); ?></h1>
</div>

<div>
    <h2>Increase balance</h2>

    <form action="<?php echo Core::app()->request()->baseUrl()?>/index/increase_balance" method="POST">
        <div class="row">
            <label for="balance">Balance</label>
            <input type="text" name="balance" id="balance" value="<?php echo $user->getBalance()?>"/>
        </div>
        <div class="row">
            <button type="submit">Save</button>
        </div>
    </form>
</div>

<div>
    <h2>Services</h2>

    <form action="<?php echo Core::app()->request()->baseUrl()?>/index/paid_service" method="POST" id="form_paid">
        <input class="" type="hidden" name="service_id" id="service_id"/>
    </form>

    <div class="row">
        <?php foreach ($user->getServices() as $service) {?>
            <div class="border-bottom">
                <p>ServiceName: <?php echo $service->getName(); ?></p>
                <p>Service is "<?php echo (!!$service->getPaid() ? 'paid' : 'not paid');?>"</p>
                <?php if (!$service->getPaid()) { ?>
                    <input class="paid" type="button" value="Paid" data-service_id="<?php echo $service->getId(); ?>"/>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="">
    <h2>jQuery</h2>
    <div>
        <div class="btn" data-amount="30">
            Button
        </div>
        <div class="btn" data-amount="20">
            Button
        </div>
        <div class="total">
            &euro; <span class="value">0.00</span>
        </div>
    </div>
</div>

<div>
    <br/>
    <a href="<?php echo Core::app()->request()->baseUrl()?>/index/clear_data">Clear Data</a>
</div>