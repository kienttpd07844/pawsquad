<script>
    "use strict";
    const attributeList = document.getElementById("attribute-list");
    const addAttributeBtn = document.getElementById("add-attribute-btn");
    let attributes = {};
    let attributesets = {};
    let attributesReady = false;
    let attributesetsReady = false;

    fetch("{{ route('admin.products.get_attribute') }}")
        .then(response => response.json())
        .then(data => {
            attributes = data.reduce((acc, curr) => {
                if (!acc[curr.attribute_set_id]) {
                    acc[curr.attribute_set_id] = [];
                }
                acc[curr.attribute_set_id].push({
                    id: curr.attribute_set_id,
                    name: curr.name,
                    idm: curr.id,
                    value: curr.value
                });
                return acc;
            }, {});
            attributesReady = true;
            checkReady();
        });

    fetch("{{ route('admin.products.get_attributeset') }}")
        .then(response => response.json())
        .then(data => {
            attributesets = data.reduce((acc, curr) => {
                acc[curr.id] = curr.name;
                return acc;
            }, {});
            attributesetsReady = true;
            checkReady();
        });

    function checkReady() {
        if (attributesReady && attributesetsReady) {
            console.log(attributes)
            addAttribute();
        }
    }

    function addAttribute() {
        const tr = document.createElement("tr");

        tr.innerHTML = `
                    <td class="text-center" style="width: 60px;">
                        <span class="drag-handle">
                            <i class="fa">&#xf142;</i><i class="fa">&#xf142;</i>
                        </span>
                    </td>
                    <td>
                        <div class="form-group">
                            <label for="attributes-0a6verqnzm-attribute-id" class="visible-xs">
                                Thông tin
                            </label>
                            <select class="form-control attribute" name="attribute">
                                <option value="" selected>Chọn thông tin</option>
                                ${Object.keys(attributesets).map(setId => `
                                                                        <optgroup label="${attributesets[setId]}">
                                                                            ${attributes[setId]?.map(attr => `
                                            <option value="${attr.id}" data-id="${attr.id}" data-idm="${attr.idm}">${attr.name}</option>
                                        `).join('') || ''}
                                                                        </optgroup>
                                                                    `).join('')}
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div id="hidden-inputs-container"></div>
                            <label for="attributes-value" class="visible-xs">
                                Giá trị
                            </label>
                            <select class="form-control select2-values" name="values[]" multiple="multiple" placeholder="Chọn giá trị"></select>
                        </div>
                    </td>
                    <td class="text-center" style="padding:0px">
                        <button type="button" class="btn btn-default delete-row">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                `;

        const select2Input = $(tr.querySelector('.select2-values')).select2({
            tags: false,
            placeholder: 'Chọn giá trị',
            allowClear: true
        });

        tr.querySelector(".attribute").addEventListener("change", function() {
            const selectedOption = this.options[this.selectedIndex];
            const attributeId = selectedOption.value;
            const attributeName = selectedOption.textContent;

            select2Input.empty();

            Object.keys(attributes).forEach(setId => {
                attributes[setId].forEach(attribute => {
                    if (attribute.id == attributeId) {
                        attribute.value.forEach(value => {
                            if (attribute.idm == selectedOption.dataset
                                .idm) {
                                const storedValue =
                                    `${attributeId}@${attribute.idm}: { "${attributeName}": "${value.value}" }`;
                                console.log(storedValue);
                                const option = new Option(value.value,
                                    storedValue, false, false);
                                select2Input.append(option);
                            }
                        });
                    }
                });
            });

            const addNewOption = new Option("Thêm giá trị mới...", "new-value", false, false);
            select2Input.append(addNewOption);

            select2Input.trigger('change');

            select2Input.off('select2:select').on('select2:select', function(e) {
                const selectedData = e.params.data;
                const selectedValue = selectedData.id;

                if (selectedValue === 'new-value') {
                    const newValue = prompt("Nhập giá trị mới:");

                    if (newValue) {
                        select2Input.find('option[value="new-value"]').remove();

                        const attribute = Object.values(attributes)
                            .flat()
                            .find(attr => attr.id == attributeId);

                        if (attribute) {
                            const newStoredValue =
                                `${attributeId}@${attribute.idm}: { "${attributeName}": "${newValue}" }`;
                            const newOption = new Option(newValue, newStoredValue, true,
                                true);
                            select2Input.append(newOption);

                            const addNewOption = new Option("Thêm giá trị mới...",
                                "new-value", false, false);
                            select2Input.append(addNewOption);

                            select2Input.trigger('change');
                        }
                    }
                }
            });
        });


        tr.querySelector(".delete-row").addEventListener("click", function() {
            attributeList.removeChild(tr);
        });

        attributeList.appendChild(tr);

        updateAttributeDropdown();

        sortable();
    }

    function updateAttributeDropdown() {
        const selectedAttributes = Array.from(document.querySelectorAll('.attribute'))
            .map(select => ({
                value: select.value,
                idm: select.selectedOptions[0]?.dataset?.idm || ""
            }))
            .filter(attr => attr.value !== "");

        document.querySelectorAll('.attribute').forEach(select => {
            Array.from(select.options).forEach(option => {
                option.disabled = false;
            });

            Array.from(select.options).forEach(option => {
                selectedAttributes.forEach(selectedAttr => {
                    if (selectedAttr.value === option.value && selectedAttr
                        .idm === option.dataset.idm && select.value !==
                        option.value) {
                        option.disabled =
                            true;
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
