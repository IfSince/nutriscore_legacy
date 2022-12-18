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
        new FormField('surname', []),
        new FormField('dateOfBirth', []),
        new FormField('height', []),
        new FormField('gender', []),
        new FormField('weight', []),

    ],
    document.querySelector('[data-quest-step="personal"]'),
    'Personal'
)

const nutritionQuestStep = new QuestStep(
    [
        new FormField('nutritionType', []),
    ],
    document.querySelector('[data-quest-step="nutrition"]'),
    'Nutrition'
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
    [accountQuestStep, personalQuestStep, nutritionQuestStep, preferencesQuestStep]
)