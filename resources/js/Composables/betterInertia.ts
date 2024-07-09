import { usePage } from "@inertiajs/vue3";
import { isNumber, pickBy, omit } from "lodash";

export function useBetterProps<T extends Record<string, any>>() {
    const { props } = usePage();

    const filteredProps: Record<string, string | any> = omit<any>(props, [
        "auth",
        "errorBags",
        "errors",
        "jetstream",
    ]);
    let finalProps: Record<string, any> = {};
    for (let i = 0; i < Object.keys(filteredProps).length; i += 2) {
        finalProps[filteredProps[i] as string] = filteredProps[i + 1];
    }

    return finalProps as Partial<T>;
}
