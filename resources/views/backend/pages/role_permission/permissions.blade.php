<div class="erp_role_permission_area ">



    <!-- single_permission  -->


    {{-- <input type="hidden" name="role_id" value="6"> --}}

    <div class="mesonary_role_header">




        {{-- <div class="single_role_blocks">
            <div class="single_permission" id="1">

                <div class="permission_header d-flex align-items-center justify-content-between">

                    <div>
                        <input type="checkbox" name="module_id[]" value="1" id="Main_Module_1"
                            class="common-radio permission-checkAll main_module_id_1" checked>
                        <label for="Main_Module_1">Dashboard</label>
                    </div>

                    <div class="arrow collapsed" data-toggle="collapse" data-target="#Role1">


                    </div>

                </div>

                <div id="Role1" class="collapse" style="background: rgb(3, 179, 248);">
                    <div class="permission_body">
                        <ul>






                            <li>
                                <div class="submodule">
                                    <input id="Sub_Module_2" name="module_id[]" value="2"
                                        class="infix_csk common-radio  module_id_1 module_link" type="checkbox" checked>

                                    <label for="Sub_Module_2">➡ Number of Student</label>
                                    <br>
                                </div>

                                <ul class="option">


                                </ul>
                            </li>









                            <li>
                                <div class="submodule">
                                    <input id="Sub_Module_9" name="module_id[]" value="9"
                                        class="infix_csk common-radio  module_id_1 module_link" type="checkbox" checked>

                                    <label for="Sub_Module_9">➡ Calendar Section</label>
                                    <br>
                                </div>

                                <ul class="option">


                                </ul>
                            </li>




                            <li>
                                <div class="submodule">
                                    <input id="Sub_Module_10" name="module_id[]" value="10"
                                        class="infix_csk common-radio  module_id_1 module_link" type="checkbox" checked>

                                    <label for="Sub_Module_10">➡ To Do list</label>
                                    <br>
                                </div>

                                <ul class="option">


                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}

        @foreach ($permissions as $permission)

        <div class="single_role_blocks">
            <div class="single_permission" id="{{ $permission->id }}">

                <div class="permission_header d-flex align-items-center justify-content-between">

                    <div>
                        <input type="checkbox" id="Main_Module_{{ $permission->id }}"
                            class="common-radio permission-checkAll main_module_id_{{ $permission->id }}" checked>
                        <label for="Main_Module_{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>

                    <div class="arrow collapsed" data-toggle="collapse" data-target="#Role{{ $permission->id }}">


                    </div>

                </div>

                <div id="Role{{ $permission->id }}" class="collapse" style="background: deepskyblue;">
                    <div class="permission_body">
                        <ul>
                            @foreach ($permission->child as $child)
                            <li>
                                <div class="submodule">
                                    <input id="Sub_Module_{{ $child->id }}" name="permission[]" value="{{ $child->id }}"
                                        class="infix_csk common-radio  module_id_{{ $permission->id }}  module_link"
                                        type="checkbox" checked>

                                    <label for="Sub_Module_{{ $child->id }}">➡ {{ $child->name }}</label>
                                    <br>
                                </div>

                                <ul class="option">


                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
