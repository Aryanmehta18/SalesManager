<style>
    #permissions{
        background:#fff;
        padding:10px;
        border-radius:8px;
    }
    #permissions .moduleName{
        font-weight:bold;
        text-transform:uppercase;
    }
    .moduleFunc{
        text-align:center;
        border:1px solid #c1c1c1;
        cursor:pointer;
    }
    .permission{
       
        margin-bottom:10px;
        margin-top:10px;
        border-bottom:1px solid #f0f0f0;
    }
    .permissionActive{
        background:#011037;
        color:#fff;
        border:1px solid #de2855;
        transition:0.3s;
    }
    </style>

<div id="permissions">
    <h4>Permissions</h4>
    <hr>
    <div id="permissionsContainer">
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Dashboard</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="dashboard_view">View</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Reports</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="report_view">View</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Purchase Order</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="po_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="po_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="po_edit">Edit</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Product</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="product_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="product_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="product_edit">Edit</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="product_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Supplier</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="supplier_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="supplier_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="supplier_edit">Edit</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="supplier_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Users</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="user_view">View</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="user_create">Create</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="user_edit">Edit</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="user_delete">Delete</p>
                </div>
            </div>
        </div>
        <div class="permission">
            <div class="row">
                <div class="col-md-3">
                    <p class="moduleName">Point Of Sale</p>
                </div>
                <div class="col-md-2">
                    <p class="moduleFunc" data-value="pos">Grant</p>
                </div>
            </div>
        </div>
    </div>
</div>
