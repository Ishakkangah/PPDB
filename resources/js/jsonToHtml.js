export default {
    methods: {
        makeParagraph(obj) {
            return `<p class="blog_post_text">
                ${obj.data.text}
            </p>`;
        },
        makeImage(obj) {
            const caption = obj.data.caption ? `<div class="blog_caption">${obj.data.caption}</div>` : '';
            return `<div class="blog_image"> 
                <img src="${obj.data.file.url}" alt="${obj.data.caption}"  width="100%">${caption}
            </div>`
        },
        makeEmbed(obj) {

        },
        makeHeader(obj) {
            return `<h${obj.data.level} class="blog_post_h${obj.data.level}">${obj.data.text}</h${obj.data.level}>`;
        },
        makeCode(obj) {

        },
        makeList(obj) {
            if (obj.data.style === 'unordered') {
                const list = obj.data.items.map(item => {
                    return `<li>${item}</li>`;
                });
                return `<ul class="blog_post_ul">${list.join('')} </ul>`;
            } else {
                const list = obj.data.items.map(item => {
                    return `<li>${item}</li>`;
                });
                return `<ul class="blog_post_ul" > ${list.join('')} </ul>`;
            }
        },
        makeQuote(obj) {
            return `<div class="spcl_line mar_b30">
                <blockquote>
                    <p class="spcl_line_p">
                        ${obj.data.text}
                    </p>
                </blockquote>
                <p>- ${obj.data.caption}</p>
            </div>`;
        }

    }
}