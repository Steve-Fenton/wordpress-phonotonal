# wordpress-phonotonal

## Theme Requirements

This theme depends on:

- Advanced Custom Fields (Delicious Brains)

## Custom Fields

Import the following fields into Advanced Custom Fields (Custom Fields -> Tools -> Import Field Groups)

```
[
    {
        "key": "group_627bcb9dac32e",
        "title": "AuthorProfile",
        "fields": [
            {
                "key": "field_627bcba441e6a",
                "label": "Avatar",
                "name": "avatar",
                "type": "image",
                "instructions": "Choose a user avatar",
                "required": 0,
                "conditional_logic": 0,
                "wrapper": {
                    "width": "",
                    "class": "",
                    "id": ""
                },
                "return_format": "id",
                "preview_size": "medium",
                "library": "all",
                "min_width": "",
                "min_height": "",
                "min_size": "",
                "max_width": "",
                "max_height": "",
                "max_size": "",
                "mime_types": ""
            }
        ],
        "location": [
            [
                {
                    "param": "user_form",
                    "operator": "==",
                    "value": "edit"
                }
            ]
        ],
        "menu_order": 0,
        "position": "normal",
        "style": "default",
        "label_placement": "top",
        "instruction_placement": "label",
        "hide_on_screen": "",
        "active": true,
        "description": "",
        "show_in_rest": 0
    },
    {
        "key": "group_6277ec54d5a41",
        "title": "Meta Tags",
        "fields": [
            {
                "key": "field_6277ec5c4fd35",
                "label": "Meta Description",
                "name": "meta_description",
                "type": "textarea",
                "instructions": "Enter a description that might be shown in search engine results.",
                "required": 0,
                "conditional_logic": 0,
                "wrapper": {
                    "width": "",
                    "class": "",
                    "id": ""
                },
                "default_value": "",
                "placeholder": "",
                "maxlength": 200,
                "rows": 5,
                "new_lines": ""
            },
            {
                "key": "field_6277ef10006df",
                "label": "Meta Keywords",
                "name": "meta_keywords",
                "type": "text",
                "instructions": "Enter keywords separated with commas.",
                "required": 0,
                "conditional_logic": 0,
                "wrapper": {
                    "width": "",
                    "class": "",
                    "id": ""
                },
                "default_value": "",
                "placeholder": "",
                "prepend": "",
                "append": "",
                "maxlength": ""
            }
        ],
        "location": [
            [
                {
                    "param": "current_user",
                    "operator": "==",
                    "value": "logged_in"
                }
            ]
        ],
        "menu_order": 0,
        "position": "side",
        "style": "default",
        "label_placement": "top",
        "instruction_placement": "label",
        "hide_on_screen": "",
        "active": true,
        "description": "",
        "show_in_rest": 0
    }
]
```