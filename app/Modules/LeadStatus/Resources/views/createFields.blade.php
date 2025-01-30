<!-- Form Fields -->
<div class="row">
    <div class="form-group col-sm-10">
        <label for="name">Status Name:<span class="required">*</span></label>
        <input type="text" name="name" id="name" class="form-control" required autocomplete="off"
               placeholder="Status Name">
    </div>
    <div class="form-group col-sm-2">
        <label for="color">Status Color:<span class="required">*</span></label>
        <div class="color-wrapper"></div>
        <input type="text" name="color" id="color" hidden class="form-control color"
               placeholder="Status Color">
        <span id="colorError" class="text-danger"></span>
    </div>
    <div class="form-group col-sm-12">
        <label for="order">Status Order:<span class="required">*</span></label>
        <input type="number" name="order" id="order" class="form-control" min="0" max="100" required
               placeholder="Status Order">
    </div>
</div>
