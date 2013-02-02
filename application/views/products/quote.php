
<?php echo validation_errors('<div class="error">', '</div>'); ?>

<form id="demo-form" method="post" action="<?= base_url() ?>products/save" data-validate="parsley">
    <label for="first_name">First Name :</label>
    <input type="text" id="first_name" name="first_name" data-required="true" />

    <label for="last_name">Last Name :</label>
    <input type="text" id="last_name" name="last_name" data-required="true" />

    <label for="company">Company :</label>
    <input type="text" id="company" name="company" data-required="false" />

    <label for="telephone">Telephone :</label>
    <input type="text" id="telephone" name="telephone" data-required="false" />

    <label for="email">Email :</label>
    <input type="text" id="email" name="email" data-trigger="change" data-required="true" data-type="email" />

    <label for="message">Message (20 chars min, 200 max) :</label>
    <textarea id="message" name="message" data-trigger="keyup" data-rangelength="[20,200]"></textarea>

    <input type="submit" />
</form>