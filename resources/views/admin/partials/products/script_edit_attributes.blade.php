<script>
    "use strict";
    const attributeList = document.getElementById("attribute-list");
    const addAttributeBtn = document.getElementById("add-attribute-btn");
    let attributes = {}; // Holds attributes data from the server
    let attributesReady = false;
    const url = window.location.href;
    const accountId = url.split('/').pop(); // Get ID from URL

    // Fetch attributes from the server
    fetch(`{{ route('admin.products.get_attribute_edit') }}/${accountId}`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            attributes = data.reduce((acc, curr) => {
                if (!acc[curr.attribute_set_id]) {
                    acc[curr.attribute_set_id] = [];
                }
                acc[curr.attribute_set_id].push({
                    id: curr.attribute_set_id,
                    name: curr.attribute_set_name,
                    value: curr.attributes.map(attr => ({
                        name: attr.name,
                        attribute: attr.attribute,
                        values: attr.value // Only selected values
                    }))
                });
                return acc;
            }, {});
            attributesReady = true;
            console.log(attributes)
            checkReady(); // Call checkReady after fetching attributes
        });

    function checkReady() {
        if (attributesReady) {
            initializeAttributes();
        }
    }



    function initializeAttributes() {
        attributeList.innerHTML = '';
        let hasSelectedAttributes = false;
        let addedAttributes = new Set();
        Object.values(attributes).forEach(attributeGroup => {
            attributeGroup.forEach(attribute => {
                attribute.value.forEach(value => {
                    value.values.forEach(val => {
                        if (val.is_selected) {
                            hasSelectedAttributes = true;
                            let attributeKey =
                                `${attribute.id}-${value.attribute}`;
                            if (!addedAttributes.has(attributeKey)) {
                                addedAttributes.add(
                                    attributeKey);
                                addAttribute(attribute.id, value.attribute,
                                    val.value);
                            }
                        }
                    });
                });
            });
        });
        if (!hasSelectedAttributes) {
            console.log("No attributes selected. You can add new attributes manually.");
        }
    }

    initializeAttributes();

    function addAttribute(attributeId, attrValue, selectedValue) {
        const tr = document.createElement("tr");

        tr.innerHTML = `
                    <td class="text-center" style="width: 60px;">
                        <span class="drag-handle">
                            <i class="fa">&#xf142;</i><i class="fa">&#xf142;</i>
                        </span>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="attributes-0a6verqnzm-attribute-id" class="visible-xs">Thuộc tính</label>
                            <select class="form-control attribute" name="attribute">
                            <option value="" ${attributeId === null ? 'selected' : ''}>Chọn thuộc tính</option>
                            ${Object.keys(attributes).map(setId => `
                                                            <optgroup label="${attributes[setId][0].name}">
                                                                ${attributes[setId].map(attr => `
                                ${attr.value.map(value => `
                                                                <option value="${attr.id}"  data-attr-value="${value.attribute}" ${attrValue === value.attribute ? 'selected' : ''}>${value.name}</option>
                                                                `).join('')}
                                `).join('')}
                                                            </optgroup>
                                                            `).join('')}
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div id="hidden-inputs-container"></div>
                            <label for="attributes-value" class="visible-xs">Giá trị</label>
                            <select class="form-control select2-values" name="values[]" multiple="multiple" placeholder="Chọn giá trị"></select>
                        </div>
                    </td>
                    <td class="text-center" style="padding:0px">
                        <button type="button" class="btn btn-default delete-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                `;

        // Initialize Select2 for the values field
        const select2Input = $(tr.querySelector('.select2-values')).select2({
            tags: false,
            placeholder: 'Chọn giá trị',
            allowClear: true
        });

        // Populate Select2 with initial values
        updateSelect2Options(attributeId, attrValue, select2Input);

        // Handle attribute change
        tr.querySelector(".attribute").addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const newAttributeId = selectedOption.value;
            const newAttrValue = selectedOption.dataset.attrValue;
            updateSelect2Options(newAttributeId, newAttrValue, select2Input);
        });

        // Handle adding new values
        select2Input.off('select2:select').on('select2:select', function(e) {
            const selectedData = e.params.data;
            const selectedValue = selectedData.id;

            if (selectedValue === 'new-value') {
                const newValue = prompt("Nhập giá trị mới:");

                if (newValue) {
                    // Lấy attributeId và attrValue từ các phần tử select
                    const selectedAttribute = tr.querySelector('.attribute');
                    const selectedOption = selectedAttribute.options[selectedAttribute
                        .selectedIndex];
                    const newAttributeId = selectedOption.value;
                    const newAttrValue = selectedOption.dataset.attrValue;

                    // Lấy tên thuộc tính
                    const attributeName = selectedAttribute.options[selectedAttribute.selectedIndex]
                        .text;

                    // Tạo newStoredValue với tên thuộc tính
                    const newStoredValue =
                        `${newAttributeId}@${newAttrValue}: { "${attributeName}":"${newValue}" }`;
                    console.log(newAttributeId, newAttrValue,
                        attributeName); // Kiểm tra các giá trị

                    // Tạo tùy chọn mới cho Select2
                    const newOption = new Option(newValue, newStoredValue, true, true);

                    // Thêm tùy chọn mới vào Select2
                    select2Input.append(newOption);

                    // Xóa tùy chọn "Thêm giá trị mới..." và thêm lại ở cuối
                    select2Input.find('option[value="new-value"]').remove();
                    const addNewOption = new Option("Thêm giá trị mới...", "new-value", false,
                        false);
                    select2Input.append(addNewOption);

                    // Cập nhật Select2
                    select2Input.trigger('change');
                } else {
                    console.log("Giá trị mới không được nhập.");
                }
            }
        });



        // Handle row deletion
        tr.querySelector(".delete-row").addEventListener("click", function() {
            attributeList.removeChild(tr);
        });

        // Add the new row to the list
        attributeList.appendChild(tr);

        // Update the attributes dropdown to disable already selected attributes
        updateAttributeDropdown();

        // Re-initialize sortable
        sortable();
    }

    function updateSelect2Options(attributeId, attrValue, select2Input) {
        // Clear existing options
        select2Input.empty();

        // Populate the select2 with options based on the selected attribute
        Object.values(attributes).forEach(attributeGroup => {
            attributeGroup.forEach(attribute => {
                if (attribute.id == attributeId) {
                    attribute.value.forEach(value => {
                        if (value.attribute == attrValue) {
                            value.values.forEach(val => {
                                // Assign value with the required format
                                const storedValue =
                                    `${attributeId}@${value.attribute}: { "${value.name}": "${val.value}" }`;
                                const option = new Option(val.value,
                                    storedValue, val.is_selected, val
                                    .is_selected);
                                select2Input.append(option);
                            });
                        }
                    });
                }
            });
        });

        // Add "Thêm giá trị mới..." option at the end
        const addNewOption = new Option("Thêm giá trị mới...", "new-value", false, false);
        select2Input.append(addNewOption);

        // Update Select2
        select2Input.trigger('change');
    }


    function updateAttributeDropdown() {
        // Lấy tất cả các giá trị thuộc tính đã chọn (bao gồm cả attributeId và attrValue)
        const selectedAttributes = Array.from(document.querySelectorAll('.attribute'))
            .map(select => ({
                value: select.value,
                attrValue: select.selectedOptions[0]?.dataset?.attrValue || ""
            }))
            .filter(attr => attr.value !== ""); // Loại bỏ các giá trị rỗng

        // Lặp qua tất cả các thẻ select.attribute
        document.querySelectorAll('.attribute').forEach(select => {
            // Đầu tiên, bỏ disable tất cả các option
            Array.from(select.options).forEach(option => {
                option.disabled = false; // Reset lại tất cả các option
            });

            // Vô hiệu hóa các tùy chọn đã được chọn trong các select khác
            Array.from(select.options).forEach(option => {
                selectedAttributes.forEach(selectedAttr => {
                    if (selectedAttr.value === option.value && selectedAttr
                        .attrValue === option.dataset.attrValue && select.value !==
                        option.value) {
                        option.disabled =
                            true; // Disable nếu option đã được chọn ở nơi khác với cùng value và attrValue
                    }
                });
            });
        });
    }


    function sortable() {
        Sortable.create(document.getElementById("attribute-list"), {
            handle: ".drag-handle",
            animation: 150
        });
    }


    addAttributeBtn.addEventListener("click", addAttribute);
    sortable();
</script>
