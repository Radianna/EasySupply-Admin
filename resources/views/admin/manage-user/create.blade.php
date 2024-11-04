<div class="modal-header">
    <h5 class="modal-title">Create User</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <p class="mb-4">Examples of standard form controls supported in an example form layout. Individual
        form controls automatically receive some global styling set by <code>.form-control</code> class.
        All textual <code>&lt;input></code>, <code>&lt;textarea></code>, and <code>&lt;select></code>
        elements with <code>.form-control</code> are set to <code>width: 100%;</code> by default. Wrap
        labels and controls in <code>div</code> container and add <code>.mb-3</code> for optimum
        spacing. Labels in horizontal form require <code>.col-form-label</code> class for proper
        spacing.</p>

    <div class="mb-4">
        <div class="fw-bold border-bottom pb-2 mb-3">Examples</div>

        <!-- Default input -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Default text input</label>
            <div class="col-lg-9">
                <input type="text" class="form-control">
            </div>
        </div>
        <!-- /default input -->


        <!-- Password -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Password</label>
            <div class="col-lg-9">
                <input type="password" class="form-control">
            </div>
        </div>
        <!-- /password -->


        <!-- Input with placeholder -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Input with placeholder</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Enter your username...">
            </div>
        </div>
        <!-- /input with placeholder -->


        <!-- Predefined value -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Predefined value</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" value="https://">
            </div>
        </div>
        <!-- /predefined value -->


        <!-- Disabled autocomplete -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Disabled autocomplete</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" placeholder="Autocomplete is off" autocomplete="off">
            </div>
        </div>
        <!-- /disabled autocomplete -->


        <!-- Maximum value -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Maximum value</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" maxlength="4" placeholder="Maximum 4 characters">
            </div>
        </div>
        <!-- /maximum value -->


        <!-- Focus on label click -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3 cursor-pointer" for="clickable_label">Focus on label
                click</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" id="clickable_label"
                    placeholder="Field focus on label click">
            </div>
        </div>
        <!-- /focus on label click -->


        <!-- Static text -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Static text</label>
            <div class="col-lg-9">
                <div class="form-control-plaintext">This is a static text</div>
            </div>
        </div>
        <!-- /static text -->


        <!-- Static input -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Static input</label>
            <div class="col-lg-9">
                <input type="text" class="form-control-plaintext" readonly value="This is a static readonly input">
            </div>
        </div>
        <!-- /static input -->


        <!-- Textarea -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Textarea</label>
            <div class="col-lg-9">
                <textarea rows="3" cols="3" class="form-control" placeholder="Default textarea"></textarea>
            </div>
        </div>
        <!-- /textarea -->

    </div>

    <div class="mb-4">
        <div class="fw-bold border-bottom pb-2 mb-3">Input sizing</div>

        <!-- Sizing -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Inputs</label>
            <div class="col-lg-9">
                <div class="mb-3">
                    <input class="form-control form-control-lg" type="text" placeholder="Large input height">
                </div>

                <div class="mb-3">
                    <input class="form-control" type="text" placeholder="Default input height">
                </div>

                <div>
                    <input class="form-control form-control-sm" type="text" placeholder="Small input height">
                </div>
            </div>
        </div>
        <!-- /sizing -->

    </div>

    <div class="mb-4">
        <div class="fw-bold border-bottom pb-2 mb-3">Input and label sizing</div>

        <!-- Large size -->
        <div class="row mb-3">
            <label class="col-form-label col-form-label-lg col-lg-3">Large size</label>
            <div class="col-lg-9">
                <input type="text" class="form-control form-control-lg"
                    placeholder=".col-form-label-lg .form-control-lg">
            </div>
        </div>
        <!-- /large size -->


        <!-- Default size -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Default size</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" placeholder=".col-form-label .form-control">
            </div>
        </div>
        <!-- /default size -->


        <!-- Small size -->
        <div class="row mb-3">
            <label class="col-form-label col-form-label-sm col-lg-3">Small size</label>
            <div class="col-lg-9">
                <input type="text" class="form-control form-control-sm"
                    placeholder=".col-form-label-sm .form-control-sm">
            </div>
        </div>
        <!-- /small size -->

    </div>

    <div>
        <div class="fw-bold border-bottom pb-2 mb-3">States</div>

        <!-- Readonly input -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Read only field</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" readonly value="Enter your username">
            </div>
        </div>
        <!-- /readonly input -->


        <!-- Disabled input -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Disabled field</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" disabled value="Enter your username">
            </div>
        </div>
        <!-- /disabled input -->


        <!-- Readonly textarea -->
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Read only textarea</label>
            <div class="col-lg-9">
                <textarea rows="3" cols="3" class="form-control" placeholder="Enter your text" readonly></textarea>
            </div>
        </div>
        <!-- /readonly textarea -->


        <!-- Disabled textarea -->
        <div class="row">
            <label class="col-form-label col-lg-3">Disabled textarea</label>
            <div class="col-lg-9">
                <textarea rows="3" cols="3" class="form-control" placeholder="Enter your text" disabled></textarea>
            </div>
        </div>
        <!-- /disabled textarea -->

    </div>
</div>
