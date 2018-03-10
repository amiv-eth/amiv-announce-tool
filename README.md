# Announce Tool
Gathers events from the AMIV API, arranges them in a selectable and sortable list and compiles the final HTML which can be sent to the members.

### Dependencies
* `jquery`
* `bootstrap`
* `mustache`
* `featherlight`

### Technical Summary
Using `jquery` all events are requested where `show_announce` is set. They are compiled into a selectable and sortable table. Selections can either be in the states "not selected", "selected for Announce" and "selected for Announce and featured".

Clicking on "preview" or "send" invokes `mustache` which enriches the templates with the actual data.  All templates are merged in their order and the generated HTML code is shown in the text field below the selection. For "preview" it is also shown in a `featherlight` pop-up.

If clicked on "send", the compiled HTML is sent to the `amivapi-announce-tool-backend`.

To run the Announce tool at `http://localhost:9000/` use:
```
npm install
npm start
```

### Styling Guide
The Announce newsletter is made of blocks. A *header* block is followed by a *content* block. There can be several *content* blocks within a *content* blick: each will get an equal share of the width.

Thanks to `mustache` content from the AMIV API can be addressed in simple curly brackets, e.g. `{{title}}`. To iterate over all elements, use `{{#_items}}...{{/_items}}`.
An psudeo-code example (based on `templates/featured.html`):
```html
<div class="block" id="header">
  ...
</div>

<div class="block" id="content">
  {{#_items}}
    <div class="block" id="content">
      ...{{img_thumbnail}}...
    </div>
    <div class="block" id="content">
      ...{{title_en}}...
    </div>
  {{/_items}}
</div>
```

### File Structure
```
amivapi-announce-tool
│   README.md                     (file you're looking at)
│   index.html                    (frontend HTML structure)
│
└───js
│   │   config.js                 (stores URL to AMIV API)
│   │   doRender.js               (renders selected events to HTML code)
│   │   eventHandlers.js          (handles clicks on the frontend's UI elements)
│   │   index.js                  (wraps all js in one file for npm)
│   │   prepareJSON.js            (localises requested JSON and adds header information)
│   
└───css
│   │   announce.css              (styles for the actual Announce)
│   │   style.css                 (styles for the frontend)
│   
└───templates
│   │   *.html                    (templates for each part of the Announce)
│   
└───images
│   │   *.png                     (images for the actual Announce)
```
