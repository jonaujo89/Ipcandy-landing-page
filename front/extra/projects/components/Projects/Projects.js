require("./Projects.tea");
const marked = require('../../lib/marked');
const {Block,Text,BlockColor,Switch,Input,Dialog,Repeater} = require("../../../../editor/components/internal"); 
const {Select} = require("../../../../editor/components/internal/Select/Select"); 
const {ProjectCard} = require("../ProjectCard/ProjectCard"); 

class Projects extends Block {
 
    static get title() { return _t('Projects') }
    static get description() { return _t('List of projects') }

    constructor(props) {
        super(props);
        this.state = {
            projects: []
        };
    }

    componentDidMount() {
        marked.setOptions({
            baseUrl: config.base_url+"/"
        });

        let searchCriteria = { type: 'project' };
        if (window.Editor.instance.props.viewOnly) {
            searchCriteria.id = this.value.items.map(one => parseInt(one.project_id));
        }

        window.SiteApp.fetchApi(
            "entity-list",
            searchCriteria,
            ({list}) => this.setState({projects:list})
        );
    }

    configForm() {
        var val = this.value;
        return html`
            <${Dialog}>
                <${Switch} name="show_title" label="${_t("Show first title")}" /> 
                <${Switch} name="show_title_2" label="${_t("Show second title")}" /> 
                <${Switch} name="show_thumbnail" label="${_t("Show image")}" /> 
                <${Switch} name="show_name" label="${_t("Show name")}" /> 
                <${Switch} name="show_desc" label="${_t("Show description")}" />  
                <${Switch} name="show_case_button" label="${_t("Show case button")}" /> 
                <label>${_t("Button text:")}</label>
                <${Input} name="button_text" />
                <label>${_t("Background color:")}</label>
                <${BlockColor} name="background" />
            <//>
        `;
    } 

    tpl_1(val) {
        return html`
        <div class="container-fluid projects projects_1 ${val.items.length === 0 ? 'empty' : ''} " style="background: ${val.background};">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        ${val.show_title && html`
                        <h1 class="title"> 
                            <${Text} name="title" options=${Text.plain_text}/>
                        </h1>
                        `}
                        ${val.show_title_2 && html`
                            <div class="title_2"> 
                                <${Text} name="title_2" options=${Text.plain_text} />
                            </div>
                        `}
                        <div class="item_list clear"> 
                            <div class="item_datas">
                                ${this.state.projects.length > 0 && html`
                                    <${Repeater} 
                                        inline=${true}
                                        repeaterDefault=${() => {
                                            return {project_id : this.state.projects[0].id}
                                        }} 
                                        name="items" 
                                        configForm=${html`
                                            <${Dialog} title=${_t("Projects")}>
                                                <label>${_t('Select a project')}</label>
                                                <${Select} name="project_id">
                                                    ${this.state.projects.map((project)=>html`
                                                        <option value=${project.id}>${project.title}</option>
                                                    `)}
                                                <//>
                                            <//>
                                        `}
                                    >${item_val => html`
                                        <${ProjectCard} 
                                            project=${this.state.projects.find(one => one.id === parseInt(item_val.project_id))}
                                            block_value=${val}
                                        //>
                                    `}<//>
                                `}
                                ${this.state.projects.length === 0 && html`
                                    <div class="projects-empty-message">
                                        ${_t('Projects are empty. Please add some projects using control panel!')}
                                    </div>
                                `}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `}

    tpl_default_1() {
        return config.language == 'en' ? {
            show_title: true,
            show_title_2: true,
            show_thumbnail: true,
            show_desc: true,
            show_case_button: true,
            background: '#F7F7F7',
            title: "Cases - how we do things",
            title_2: "Over 6 years we have implemented 102 projects and here are some real cases",
            button_text: "Read Case",
            items: [],
        } : {
            show_title: true,
            show_title_2: true,
            show_thumbnail: true,
            show_desc: true,
            show_case_button: true,
            background: '#F7F7F7',
            title: "Наш подход к решению задач",
            title_2: "За 5 лет мы успели сдать 97 проектов и вот несколько типовых историй",
            button_text: "Читать кейс",
            items: [],
        }
    }
} 

exports.Projects = Projects;

