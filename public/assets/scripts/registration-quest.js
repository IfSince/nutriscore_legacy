import {FormField} from "./quest/form-field.js"
import {QuestStep} from "./quest/quest-step.js";
import {Quest} from "./quest/quest.js";

const accountQuestStep = new QuestStep(
    [
        new FormField('username', []),
        new FormField('email', []),
        new FormField('password', []),
        new FormField('repeatPassword', []),
    ],
    document.querySelector('[data-quest-step="account"]'),
    'Account'
)

const personalQuestStep = new QuestStep(
    [
        new FormField('firstName', []),
        new FormField('surname', [])
    ],
    document.querySelector('[data-quest-step="personal"]'),
    'Personal'
)

const addressQuestStep = new QuestStep(
    [
        new FormField('street', []),
        new FormField('country', [])
    ],
    document.querySelector('[data-quest-step="address"]'),
    'Address'
)

const preferencesQuestStep = new QuestStep(
    [
        new FormField('preferences', []),
    ],
    document.querySelector('[data-quest-step="preferences"]'),
    'Preferences'
)


const registrationQuest = new Quest(
    'registrationForm',
    [accountQuestStep, personalQuestStep, addressQuestStep, preferencesQuestStep]
)